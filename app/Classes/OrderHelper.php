<?php

namespace App\Classes;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Config;
use App\Classes\NumberToText;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Luecano\NumeroALetras\NumeroALetras;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Illuminate\Support\Facades\File;

class OrderHelper
{
	public $config;
	public function __construct()
	{
		$this->config = Config::find(1);
	}

	public function addAddenda($order)
	{
		$result = '';
		$xml = base64_decode($order->stamp->xml);
		//Walmart
		if ($order->client->id == 2) {
			$pos = strpos($xml, "</cfdi:Comprobante>");
			$part1 = substr($xml, 0, $pos);
			$part2 = substr($xml, $pos, strlen($xml));
			//dd($pos, $part1, $part2);
			$addenda = '
		<cfdi:Addenda>
			<WM:AddendaWalmart 
				xsi:schemaLocation="http://www.pegasotecnologia.com/secfd/Schemas/Receptor/Walmart http://www.pegasotecnologia.com/secfd/Schemas/Receptor/AddendaWalmart.xsd" Anio="'.(date("Y")).'" FolioRecibo="'.$order->id.'" ordenCompra="'.$order->order_number.'" numeroProveedor="'.$order->supplier_number.'" unidadCEDIS="'.$order->branch_code.'" xmlns:WM="http://www.pegasotecnologia.com/secfd/Schemas/Receptor/Walmart"/>
		</cfdi:Addenda>
		';
			$result = "{$part1}{$addenda}{$part2}";
		} elseif ($order->client->id == 1){
			$pos = strpos($xml, "</cfdi:Comprobante>");
			$part1 = substr($xml, 0, $pos);
			$part2 = substr($xml, $pos, strlen($xml));
			//dd($pos, $part1, $part2);
			$formatter = new NumeroALetras();
			$formatter->apocope = true;
			$totalCost = 0;
			$totalGSTAmount = 
			$totalTaxAmount = 0;
			foreach($order->orderRows as $key => $row){
				$totalCost += $row->cost_total;
				$totalGSTAmount += $row->cost_total * 0.08;
			}
			$addenda = '
		<cfdi:Addenda>
			<requestForPayment xmlns="http://www.sat.gob.mx/cfd/4" DeliveryDate="'.(date("Y-m-d")).'" contentVersion="1.3.1" documentStatus="ORIGINAL" documentStructureVersion="AMC7.1" type="SimpleInvoiceType">
				<requestForPaymentIdentification>
					<entityType>INVOICE</entityType>
					<uniqueCreatorIdentification>"'.$order->id.'"</uniqueCreatorIdentification>
				</requestForPaymentIdentification>
				<specialInstruction code="ZZZ">
					<text>'.$formatter->toMoney($totalCost, 2, 'PESOS', 'CENTAVOS').' M. N.'.'</text>
				</specialInstruction>
				<orderIdentification>
					<referenceIdentification type="ON">"'.$order->order_number.'"</referenceIdentification>
					<ReferenceDate>"'.substr($order->order_date, 0, 10).'"</ReferenceDate>
				</orderIdentification>
				<AdditionalInformation>
					<referenceIdentification type="ATZ">??</referenceIdentification>
				</AdditionalInformation>
				<DeliveryNote> 
                 <referenceIdentification>0</referenceIdentification>
                 <ReferenceDate>2023-05-25</ReferenceDate>
                </DeliveryNote>
                <buyer>
                    <gln>Necesito el GLN de HEB</gln>
                    <contactInformation>
                     	<personOrDepartmentName>
                     		<text>GIL</text>
                     	</personOrDepartmentName>
                    </contactInformation>
                </buyer>
				<seller>
					<gln>7504025406005</gln>
					<alternatePartyIdentification type="SELLER_ASSIGNED_IDENTIFIER_FOR_A_PARTY">"'.$order->supplier_number.'"</alternatePartyIdentification>
				</seller>
				<shipTo>
				<gln>'.$order->gln.'</gln>
				<nameAndAddress>';
				$aShip = explode("\n", $order->ship_to);
				if ($aShip[1] ?? false) {
					$addenda .= '
					<name>'.$aShip[1].'</name>
					<streetAddressOne>ANILLO PERIFCTRO</streetAddressOne>
					<city>'.$aShip[3].'</city>
					<postalCode>'.substr($order->ship_to, strpos($order->ship_to, 'C.P.') + 4, 5).'</postalCode>';
				} else {
					$addenda .= '
					<name>'.$order->ship_to.'</name>';
				}
				$addenda .= '
				</nameAndAddress>
				</shipTo>
                <currency currencyISOCode="'.$order->currency_type.'">
                    <currencyFunction>BILLING_CURRENCY</currencyFunction>
                    <rateOfChange>1</rateOfChange>
                </currency>
				<paymentTerms PaymentTermsRelationTime="REFERENCE_AFTER" paymentTermsEvent="DATE_OF_INVOICE">
					<netPayment netPaymentTermsType="BASIC_NET">
						<paymentTimePeriod>
							<timePeriodDue timePeriod="DAYS">
								<value>30</value>
							</timePeriodDue>
						</paymentTimePeriod>
					</netPayment>
					<discountPayment discountType="ALLOWANCE_BY_PAYMENT_ON_TIME">
						<percentage>0</percentage>
					</discountPayment>
                </paymentTerms>
		';
		foreach ($order->orderRows as $key => $row){
			$addenda .= '
				<lineItem number="'.$row->line.'" type="SimpleInvoiceLineItemType">
					<tradeItemIdentification>
						<gtin>"'.$row->product_code.'" tengo duda</gtin>
					</tradeItemIdentification>
					<alternateTradeItemIdentification type="BUYER_ASSIGNED">300048978</alternateTradeItemIdentification>
					<tradeItemDescriptionInformation language="ES">
						<longText>"'.$order->description.'"</longText>
					</tradeItemDescriptionInformation>
					<invoicedQuantity unitOfMeasure="CJA">4</invoicedQuantity>
					<grossPrice>
						<Amount></Amount>
					</grossPrice>
					<netPrice>
						<Amount>"'.$order->cost.'"</Amount>
					</netPrice>
					<tradeItemTaxInformation>
						<taxTypeDescription>VAT</taxTypeDescription>
						<tradeItemTaxAmount>
						<taxPercentage>0</taxPercentage>
						<taxAmount>0</taxAmount>
						</tradeItemTaxAmount>
					</tradeItemTaxInformation>
					<tradeItemTaxInformation>
						<taxTypeDescription>GST</taxTypeDescription>
						<tradeItemTaxAmount>
							<taxPercentage>8</taxPercentage>
							<taxAmount>169.13 Debe ser con el gross amount</taxAmount>
						</tradeItemTaxAmount>
					</tradeItemTaxInformation>
					<totalLineAmount>
						<grossAmount>
							<Amount>2114.17</Amount>
						</grossAmount>
						<netAmount>
							<Amount>'.$row->cost_total.'</Amount>
						</netAmount>
					</totalLineAmount>
				</lineItem>
			';
		}

		$addenda .= '
				<totalAmount>
					<Amount>'.$totalCost.'</Amount>
				</totalAmount>
				<TotalAllowanceCharge allowanceOrChargeType="ALLOWANCE">
					<specialServicesType> </specialServicesType> 
					<Amount>87.08</Amount>
				</TotalAllowanceCharge>
				<baseAmount>
					<Amount>4353.77</Amount>
				</baseAmount>
				<tax type="VAT">
					<taxPercentage>0</taxPercentage>
					<taxAmount>0</taxAmount>
					<taxCategory>TRANSFERIDO</taxCategory>
				</tax>
				<tax type="GST">
					<taxPercentage>8</taxPercentage>
					<taxAmount>'.$totalGSTAmount.'</taxAmount>
					<taxCategory>TRANSFERIDO</taxCategory>
				</tax>
				<payableAmount>
					<Amount>4608.02</Amount>
				</payableAmount>


			</requestForPayment>
		</cfdi:Addenda>
		';
			$result = "{$part1}{$addenda}{$part2}";
		} else {
			$result = $xml;
		}
		return $result;
	}

	public function laodPDF($view, $data, $type = "output", $sheetSize = "A4", $orientation = "vertical")
	{
		$pdf = PDF::loadView($view, $data);
		$pdf->setPaper($sheetSize, $orientation);
		$pdf->render();
		if ($type = "stream") {
			$result = $pdf->stream("file.pdf", ["Attachment" => false]);
		} else {
			$result = $pdf->output();
		}
		return $result;
	}

	public function generateQR($params)
	{
		//Generate url
		$url = "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?";

		foreach ($params as $key => $value) {
			$url .= $key.'='.$value .'&';
		}
		$url = substr($url, 0, strlen($url)-1);



		$qr = QrCode::create($url)
			->setEncoding(new Encoding('UTF-8'))
			->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
			->setSize(300)
			->setMargin(10)
			->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
			->setForegroundColor(new Color(0, 0, 0))
			->setBackgroundColor(new Color(255, 255, 255));
		
		$writer = new PngWriter();
		$result = $writer->write($qr);
		
		return $result->getDataUri();
	}

	public function formatDateHEB($param) {
		$p = explode("/", $param);
		return ($p[2] ?? false) ? "{$p[2]}-{$p[1]}-{$p[0]}" : null;
	}

	/**
	 * [getPDFContent] Invoice data 
	 *
	 * @param [type] $order
	 * @param string $type
	 * @return void
	 */
	public function getPDFContent($order, $type = "output")
	{
		$result = '';
		$config = $this->config;

		//Set xml data as array (only first lvl)
		if ($order->stamp ?? false) {
			$order->stamp->stamp_array = json_decode(json_encode((array) simplexml_load_string(base64_decode($order->stamp->xml), 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			$order->stamp->cfdi_type = "I-Ingreso 4.0";
		}
		
		//Set total
		$order->total = 0;
		$order->total_taxes = 0;
		foreach ($order->orderRows as $key => $row) {
			$order->total += floatval($row->cost_total);
			$row->taxes = floatval($row->cost_total) * floatval($row->product->tax_rate);
			$order->total_taxes += floatval($row->taxes);
		}
		$order->total_total = floatval($order->total) + floatval($order->total_taxes);

		//Total as text
		$order->total_letter = (new NumberToText)->toInvoice($order->total_total, 2, 'PESOS');
		
		//QR
		if ($order->stamp ?? false) {
			$order->stamp->qr = $this->generateQR([
				"id" => $order->stamp->uuid,
				"re" => $config->rfc,
				"rr" => $order->client->rfc,
				"tt" => $order->total_total,
				"fe" => substr($order->stamp->cfd_seal, strlen($order->stamp->cfd_seal)-8, strlen($order->stamp->cfd_seal)),
			]);
		}

		//Logo
		$order->logo = "data:image/png;base64,".base64_encode(File::get(public_path("images/logo.png")));
		$result = $this->laodPDF('pdf.invoice', compact('order', 'config'));
		return $result;
	}


	public function getPDFPaymentContent($order_payment)
	{
		$result = '';
		$config = $this->config;

		//Set xml data as array (only first lvl)
		$order_payment->stamp_array = json_decode(json_encode((array) simplexml_load_string(base64_decode($order_payment->xml), 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		$order_payment->cfdi_type = "P-Pago 4.0";
		
		//Total as text
		$order_payment->total_letter = (new NumberToText)->toInvoice($order_payment->total, 2, 'PESOS');
		
		//QR
		$order_payment->qr = (new OrderHelper)->generateQR([
			"id" => $order_payment->uuid,
			"re" => $config->rfc,
			"rr" => $order_payment->client->rfc,
			"tt" => $order_payment->total,
			"fe" => substr($order_payment->cfd_seal, strlen($order_payment->cfd_seal)-8, strlen($order_payment->cfd_seal)),
		]);
		//Logo
		$order_payment->logo = "data:image/png;base64,".base64_encode(File::get(public_path("images/logo.png")));
		$result = $this->laodPDF('pdf.payment', compact('order_payment', 'config'));
		return $result;
	}


	public function getPDFCreditnoteContent($credit_note)
	{
		$result = '';
		$config = $this->config;

		//Set xml data as array (only first lvl)
		$credit_note->stamp_array = json_decode(json_encode((array) simplexml_load_string(base64_decode($credit_note->xml), 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		$credit_note->cfdi_type = "E-Egreso";
		
		//Total as text
		$credit_note->total_letter = (new NumberToText)->toInvoice($credit_note->total, 2, 'PESOS');
		
		//QR
		$credit_note->qr = (new OrderHelper)->generateQR([
			"id" => $credit_note->uuid,
			"re" => $config->rfc,
			"rr" => $credit_note->stamp->order->client->rfc,
			"tt" => $credit_note->total,
			"fe" => substr($credit_note->cfd_seal, strlen($credit_note->cfd_seal)-8, strlen($credit_note->cfd_seal)),
		]);
		//Logo
		$credit_note->logo = "data:image/png;base64,".base64_encode(File::get(public_path("images/logo.png")));
		$result = $this->laodPDF('pdf.credit-note', compact('credit_note', 'config'));
		return $result;
	}
}