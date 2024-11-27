<?php
namespace App\Classes;

use Illuminate\Support\Facades\Route as RouteBase;
use Illuminate\Support\Str;

use Smalot\PdfParser\Parser;
use Aspose\Words\WordsApi;
use Spatie\PdfToText\Pdf;

class PurchaseOrderWalmart extends PurchaseOrder
{
	private $lang;

	public function __construct(Type $var = null) {
		$this->lang = $this->getTranslations(2);
	}
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
		//Sect1
		extract($this->getValue("order_number", $this->lang["order_number"], "\r\n", $data, $result));
		extract($this->getValue("order_date", $this->lang["order_date"], "\r\n", $data, $result));
		//$limiterSD = strpos($data, "Fecha De Envio") ? "Fecha De Envio " : "Fecha DeEnvio ";
		extract($this->getValue("shipping_date", $this->lang["shipping_date"], "\r\n", $data, $result));
		extract($this->getValue("cancel_date", $this->lang["cancel_date"], "\r\n", $data, $result));

		//Sect2
		extract($this->getValue("order_type", $this->lang["order_type"], "\r\n", $data, $result));
		extract($this->getValue("currency_type", $this->lang["currency_type"], "\r\n", $data, $result));
		extract($this->getValue("department", $this->lang["department"], "\r\n", $data, $result));
		extract($this->getValue("promotional_event", $this->lang["promotional_event"], "\r\n", $data, $result));
		extract($this->getValue("payment_terms", $this->lang["payment_terms"], $this->lang["fob_prepaid"], $data, $result));
		extract($this->getValue("fob", $this->lang["fob"], "\r\n", $data, $result));
		extract($this->getValue("fob_details", $this->lang["fob_details"], $this->lang["carrier"], $data, $result));
		extract($this->getValue("carrier", $this->lang["carrier"], $this->lang["ship_to"], $data, $result));

		//Sect3
		extract($this->getValue("ship_to", $this->lang["ship_to"], $this->lang["pay_to"], $data, $result));
		//Sect4
		extract($this->getValue("pay_to", $this->lang["pay_to"], $this->lang["store"], $data, $result));
		//Sect5
		extract($this->getValue("store", $this->lang["store"] , $this->lang["supplier"], $data, $result));
		//Sect6
		extract($this->getValue("supplier_name", $this->lang["supplier_name"], $this->lang["supplier_number"], $data, $result));
		extract($this->getValue("supplier_number", $this->lang["supplier_number"], "\r\n", $data, $result));

		return $result;
	}

	public function getDetails($data)
	{
		$result = [];
		extract($this->getValue("x", 0, $this->lang["extended_cost"], $data, $result));
		extract($this->getValue("x", 0, "\r\n", $data, $result));
		unset($result["x"]);
		
		$data = substr($data, 0, strpos($data, $this->lang["total_order_amount"]));
		
		//Breakline check on GTIN13
		/*preg_match("(GTIN-\r\n13)", $data, $matches);
		if (count($matches) > 0) {
			$data = str_replace("(GTIN-\r\n13)\r\n", "(GTIN-13) ", $data);
		} else {
			$data = trim(str_replace("13)\r\n", ")13 ", $data));
		}*/
		$data = str_replace("(GTIN-\r\n13)\r\n", "(GTIN-13) ", $data);
		//$data = str_replace("13)\r\n", "13) ", $data);
		$data = str_replace("/\r\n", "/ ", $data);
		$data = str_replace("\r\nPZ\r\n", " PZ ", $data);
		
		$rows = $this->cleanArray($data);

		foreach ($rows as $key => $row) {
			$result[] = $this->getRow($row);
		}

		return $result;
	}

	public function getRow($data)
	{
		$result = [];
		
		$data = explode(" ", $data);
		$p = array_key_last($data);

		extract($this->getCol("line", 0, $data, $result));
		extract($this->getCol("product_code", 1, $data, $result));
		extract($this->getCol("gtin", 2, $data, $result));
		extract($this->getCol("cost_total", $p, $data, $result));
		extract($this->getCol("cost", $p-1, $data, $result));
		extract($this->getCol("package", [$p-4, $p-3, $p-2], $data, $result));
		extract($this->getCol("uom", $p-5, $data, $result));
		extract($this->getCol("amount", $p-6, $data, $result));
		if (!is_numeric($data[$p-8])) {
			extract($this->getCol("size", $p-7, $data, $result));
			extract($this->getCol("color", $p-8, $data, $result));
			extract($this->getCol("stock_number", $p-9, $data, $result));
		} else {
			extract($this->getCol("size", [$p-8, $p-7], $data, $result));
			extract($this->getCol("color", $p-9, $data, $result));
			extract($this->getCol("stock_number", $p-10, $data, $result));
		}
		$result["gtin_type"] = implode(" ", $data);

		return $result;
	}

	private function getTranslations($type = 1)
	{
		if ($type == 1) {
			$translations = [
				"order_number" => "Purchase Order Number ",
				"order_date" => "Purchase Order Date ",
				"shipping_date" => "Fecha De Envio ",
				"cancel_date" => "Fecha De Cancelacion ",
				"order_type" => "Tipo De Orden ",
				"currency_type" => "Moneda ",
				"department" => "Department ",
				"promotional_event" => "Promotional Event ",
				"payment_terms" => "PaymentTerms ",
				"fob" => "F.O.B. ",
				"fob_prepaid" => "F.O.B. Prepago",
				"fob_details" => "Embarque",
				"carrier" => "Portador ",
				"ship_to" => "Enviar a:\r\n",
				"pay_to" => "Pagar A",
				"store" => "Formato De Tienda",
				"supplier" => "Supplier",
				"supplier_name" => "Proveedor",
				"supplier_number" => "Supplier Number",
				"extended_cost" => "Costo Extendí\r\n",
				"total_order_amount" => "Cantidad total ordenada",
			];
		} else {
			$translations = [
				"order_number" => "Purchase Order Number ",
				"order_date" => "Purchase Order Date ",
				"shipping_date" => "Ship Date ",
				"cancel_date" => "Cancel Date ",
	
				"order_type" => "Order Type ",
				"currency_type" => "Currency ",
				"department" => "Department ",
				"promotional_event" => "Promotional Event ",
				"payment_terms" => "Payment Terms ",
				"fob" => "F.O.B. ",
				"fob_prepaid" => "F.O.B. Prepaid",
				"fob_details" => "Ship Point",
				"carrier" => "Carrier ",
	
				"ship_to" => "Ship To",
				"pay_to" => "Bill To",
				"store" => "Store Format",
				"supplier" => "Supplier",
				"supplier_name" => "Supplier Name",
				"supplier_number" => "Supplier Number",
				"extended_cost" => "Extended Cost\r\n",
				"total_order_amount" => "Total Order Amount",
			];
		}

		return $translations;
	}
}