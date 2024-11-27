<?php
namespace App\Classes;

use Illuminate\Support\Facades\Route as RouteBase;
use Illuminate\Support\Str;
use App\Models\Product;
use Smalot\PdfParser\Parser;
use Aspose\Words\WordsApi;
use Spatie\PdfToText\Pdf;

class PurchaseOrderHEB extends PurchaseOrder
{
	public function parseOrder($data)
	{
		$result = [];
		$result["headers"] = $this->getHeaders($data);
		$result["rows"] = $this->getDetails($data);
		return $result;
	}

	public function getHeaders($data)
	{
		$result = [];
		// extract($this->getValue("provider_name", "Facturar a\r\n", "\r\n", $data, $result));
		// extract($this->getValue("provider_phone", 0, "\r\n", $data, $result));
		// extract($this->getValue("invoice_to", 0, "RFC:", $data, $result));
		// extract($this->getValue("provider_rfc", "RFC: ", "\r\n", $data, $result));
		// extract($this->getValue("order_number", "Fecha Rec\r\n", "\r\n", $data, $result));
		// extract($this->getValue("department", 0, "\r\n", $data, $result));
		// extract($this->getValue("order_date", 0, "\r\n", $data, $result));
		// extract($this->getValue("send_date", 0, "\r\n", $data, $result));
		// extract($this->getValue("send_to", 0, "Orden Consolidada", $data, $result));
		// extract($this->getValue("currency_type", "Tipo de Moneda ", "\r\n", $data, $result));
		// extract($this->getValue("total", "Total Antes de Impuestos $ ", "\r\n", $data, $result));
		// extract($this->getValue("consultation_date", 0, "\r\n", $data, $result));

		extract($this->getValue("supplier_number", "Facturar a\r\n", "-", $data, $result));
		extract($this->getValue("supplier_name", "- ", "\r\n", $data, $result));
		extract($this->getValue("supplier_phone", 0, "\r\n", $data, $result));
		extract($this->getValue("pay_to", 0, "RFC:", $data, $result));
		extract($this->getValue("provider_rfc", "RFC: ", "\r\n", $data, $result));
		extract($this->getValue("order_number", "Fecha Rec\r\n", "\r\n", $data, $result));
		extract($this->getValue("department", 0, "\r\n", $data, $result));
		extract($this->getValue("order_date", 0, "\r\n", $data, $result));
		extract($this->getValue("send_date", 0, "\r\n", $data, $result));
		extract($this->getValue("ship_to", 0, "Orden Consolidada", $data, $result));
		extract($this->getValue("currency_type", "Tipo de Moneda ", "\r\n", $data, $result));
		extract($this->getValue("total", "Total Antes de Impuestos $ ", "\r\n", $data, $result));
		extract($this->getValue("consultation_date", 0, "\r\n", $data, $result));
		//dd($result);

		return $result;
	}

	public function getDetails($data)
	{
		$result = [];
		//Section rows
		$pos = strpos($data, "ORDEN DE COMPRA");
		$sect = substr($data, 0, $pos);
		$sect = trim($sect);
		$sect = explode("\r\n", $sect);
		$sect = $this->checkRows($sect);
		foreach ($sect as $key => $row) {
			
			$result[] = $this->getRow($row);				
		}
		//dd($result);
		return $result;
	}

	public function getRow($data)
	{
		$result = [];

		$data = explode(" ", $data);
		$p = array_key_last($data);
		extract($this->getCol("product_code", 0, $data, $result)); //new
		extract($this->getCol("gtin", 1, $data, $result));
		extract($this->getCol("provider_number", 2, $data, $result)); //new
		extract($this->getCol("price_limit_date", $p, $data, $result)); //new
		extract($this->getCol("amount", $p-1, $data, $result));
		extract($this->getCol("total_casepack", $p-2, $data, $result));
		extract($this->getCol("pieces", $p-3, $data, $result)); //new
		extract($this->getCol("units_casepack", $p-4, $data, $result)); //new
		extract($this->getCol("capacity", [$p-6, $p-5], $data, $result)); //new
		$result["description"] = implode(" ", $data);

		$product = Product::where('upc', $result["gtin"])->first();
		$price = $product->prices->where("client_id", 1)->first();
		if ($price != null) {
			$result["cost"] = $price->price;
			$result["cost_total"] = $price->price * $result["amount"];
		}
		return $result;
	}

	public function checkRows($sect)
	{
		$result = [];
		$previousRow = '';
		$nextRow = '';
		$isCut = false;
		foreach($sect as $key => $row){
			// Si la row está cortada y es la parte más pequeña
			if(strlen($row) < 15){
				//Obtenemos la siguiente row
				$nextRow = $sect[$key + 1];
				//Juntamos las 3 rows
				if(strlen($row) < 3){
					//Obtenemos la row anterior
					$previousRow = $sect[$key - 1];
					$rowHelper = $previousRow . $row . " " . $nextRow;
					array_pop($result);
				}else{
					//Obtenemos la row anterior
					$previousRow = array_pop($result);
					$rowHelper = $previousRow . " " . $row . " " . $nextRow;
				}
				
				// if (($keyResult = array_search($sect[$key-1], $result)) !== false) {
				// 	unset($result[$keyResult]);
				// }
				$isCut = true;
				array_push($result, $rowHelper);
			}elseif(!$isCut){
				//Si la row no está cortada la agregamos al array
				array_push($result, $row);
			}else{
				//Si la row está cortada no se agrega al array y volvemos a poner false el booleano
				$isCut = false;
			}
		}
		
		return $result;
	}
}