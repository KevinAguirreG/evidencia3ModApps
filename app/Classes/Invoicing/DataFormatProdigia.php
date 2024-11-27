<?php
namespace App\Classes\Invoicing;

use App\Models\Config;
use CfdiUtils\CfdiCreator40;
use CfdiUtils\Certificado\Certificado;
use PhpCfdi\Credentials\Credential;

class DataFormatProdigia
{
	private function numberInvoice($param)
	{
		return (float) number_format($param, 6, '.', '');
	}

	public function getCFDI($order)
	{
		$config = Config::find(1);
		$data = [
			"attr" => [
				'Fecha' => date("Y-m-d\TH:i:s", strtotime ('-1 hour', strtotime(date("Y-m-d H:i:s")))),
				'TipoDeComprobante' => 'I',
				'FormaPago' => $order->paymentType->name,
				'MetodoPago' => $order->paymentMethod->name,
				'Exportacion' => '01',
				'Moneda' => $order->currency_type,
				'LugarExpedicion' => $config->zipcode,
				'Folio' => $order->id,
				'SubTotal' => '',
				'Total' => '',
			],
			"emisor" => [
				'Rfc' => $config->rfc,
				'Nombre' => $config->company_name,
				'RegimenFiscal' => $config->regime->name,
			],
			"receptor" => [
				'Rfc' => $order->client->rfc,
				'Nombre' => $order->client->company_name,
				'DomicilioFiscalReceptor' => $order->client->zipcode,
				'RegimenFiscalReceptor' => $order->client->regime->name,
				'UsoCFDI' => $order->client->cfdiUse->name,
			],
			"addenda" => [
				'xsi:schemaLocation' => "http://www.pegasotecnologia.com/secfd/Schemas/Receptor/Walmart http://www.pegasotecnologia.com/secfd/Schemas/Receptor/AddendaWalmart.xsd",
				'Anio' => "2023",
				'FolioRecibo' => "2127962178",
				'ordenCompra' => "2127962178",
				'numeroProveedor' => "041789460",
				'unidadCEDIS' => "7471",
				'xmlns:WM' => "http://www.pegasotecnologia.com/secfd/Schemas/Receptor/Walmart",
			],
		];

		$subtotal = 0;
		$totalTax = 0;
		foreach ($order->orderRows as $key => $row) {
			$cost = $row->cost ?? $row->product->price;
			$costTotal = floatval($row->amount) * floatval($cost);
			$subtotal += $costTotal;
			$taxAmount = floatval($costTotal) * floatval($row->product->tax_rate);
			$totalTax += $taxAmount;
			$amountPerPack = floatval($row->amount) / floatval($row->product->pieces);
			$data["concepts"][] = [
				'ClaveProdServ' => $row->product->product_code,
				'NoIdentificacion' => $row->product_code,
				'Cantidad' => number_format($row->amount, 6, '.', ''),
				'ClaveUnidad' => $row->product->unit_code,
				'Unidad' => $row->product->unit,
				'Descripcion' => $row->product->name." ".$row->product->upc." (".$row->product->gtin_type.") ".$row->product->packing_type." ".$amountPerPack,
				'ValorUnitario' => number_format($cost, 6, '.', ''),
				'Importe' => number_format($costTotal, 6, '.', ''),
				'ObjetoImp' => '02',
				'transfer' => [
					'Base' => number_format($costTotal, 6, '.', ''),
					'Impuesto' => $row->product->tax->name,
					'TipoFactor' => $row->product->factor_type,
					'TasaOCuota' => number_format($row->product->tax_rate, 6, '.', ''),
					'Importe' => number_format($taxAmount, 6, '.', ''),
				],
			];
		}
		$data["attr"]["SubTotal"] = number_format($subtotal, 2, '.', '');
		$data["attr"]["Total"] = number_format($subtotal+$totalTax, 2, '.', '');

		return $data;
	}

	public function getXML($order)
	{
		$result = ["status" => true];
		$data = $this->getCFDI($order);
		$path = 'cert/CSD_VUCEM';
		$csd = Credential::openFiles(
			"file://".public_path($path.'/00001000000509270999.cer'), 
			"file://".public_path($path.'/CSD_VUCEM_ZIN1612074A8_20211005_104854.key'), 
			"bambu2021"
		);
		//$creator = new CfdiCreator40($comprobanteAtributos, $certificado);
		$creator = new CfdiCreator40($data["attr"]);

		$creator->putCertificado(
			new Certificado($csd->certificate()->pem()),
			false
		);

		$comprobante = $creator->comprobante();

		$comprobante->addEmisor($data["emisor"]);

		$comprobante->addReceptor($data["receptor"]);

		/*if ($data["addenda"] ?? false) {
			$comprobante->addAddenda($data["addenda"]);
		}*/


		foreach ($data["concepts"] as $key => $row) {
			$transfer = $row["transfer"];
			unset($row["transfer"]);
			$comprobante->addConcepto($row)->addTraslado($transfer);
		}

		
		$creator->addSumasConceptos(null, 2);
		//$creator->addSello($cert_key);
		$creator->addSello($csd->privateKey()->pem(), $csd->privateKey()->passPhrase());
		//$creator->moveSatDefinitionsToComprobante();
		$asserts = $creator->validate();
		if ($asserts->hasErrors()) { // contiene si hay o no errores
			$result["status"] = false;
			$result["message"] = $asserts->errors();
		} else {
			$result["xml"] = $creator->asXml();
		}

		return $result;
	}
}