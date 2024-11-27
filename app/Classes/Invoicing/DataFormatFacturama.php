<?php
namespace App\Classes\Invoicing;

use App\Models\Config;

class DataFormatFacturama
{
	public $config;
	public $isProduction;

	public function __construct()
	{
		$this->config = Config::find(1);
		$this->isProduction = str_contains(config('invoicing.facturama.uri'), "sandbox") ? false : true;
	}

	private function numberInvoice($param, $decimal = 6)
	{
		return number_format($param, $decimal, '.', '');
	}
	
	public function getCFDI($order)
	{
		$result = [
			"NameId" => "1",
			"Currency" => $order->currency_type,
			"Folio" => $order->id,
			"CfdiType" => "I",
			"PaymentForm" => $order->paymentType->name,
			"PaymentMethod" => $order->paymentMethod->name,
			"OrderNumber" => $order->order_number,
			"ExpeditionPlace" => $this->isProduction ? $this->config->zipcode : "78000",
			"Date" => date("Y-m-d\TH:i:s-06:00"),
			"Exportation" => "01",
			"Receiver" => [
				'Rfc' => $order->client->rfc,
				'CfdiUse' => $order->client->cfdiUse->name,
				'Name' => $order->client->company_name,
				'FiscalRegime' => $order->client->regime->name,
				'TaxZipCode' => $order->client->zipcode,
			],
			"Items" => [],
		];

		$subtotal = 0;
		$totalTax = 0;
		foreach ($order->orderRows as $key => $row) {
			$amountPerPack = floatval($row->amount) / floatval($row->product->pieces);
			$cost = $row->cost ?? $row->product->price;
			$costTotal = floatval($row->amount) * floatval($cost);
			$taxAmount = floatval($costTotal) * floatval($row->product->tax_rate);
			//$subtotal += $costTotal;
			//$totalTax += $taxAmount;
			$result["Items"][] = [
				'ProductCode' => $row->product->product_code,
				'IdentificationNumber' => $row->product_code,
				'Description' => $row->product->name." ".$row->product->upc." (".$row->product->gtin_type.") ".$row->product->packing_type." ".$amountPerPack,
				'Unit' => $row->product->unit ?? "NO APLICA",
				'UnitCode' => $row->product->unit_code,
				'UnitPrice' => $this->numberInvoice($cost),
				'Quantity' => $this->numberInvoice($row->amount),
				'Subtotal' => $this->numberInvoice($costTotal),
				'TaxObject' => '02',
				'Taxes' => [
					[
						'Total' => $this->numberInvoice($taxAmount),
						'Name' => $row->product->tax->description,
						'Base' => $this->numberInvoice($costTotal),
						'Rate' => $this->numberInvoice($row->product->tax_rate),
						'IsRetention' => false,
					]
				],
				'Total' => $this->numberInvoice($costTotal+$taxAmount),
			];
		}

		return $result;
	}

	public function getPayment($payment)
	{
		$relatedDocuments = [];
		foreach ($payment["payments"] as $key => $row) {
			$relatedDocuments[] = [
				"TaxObject" => "02",
				"Uuid" => $row["order"]->stamp->uuid,
				"PartialityNumber" => $row["partiality_number"],
				//"Serie" => "1111",
				//"Folio" => "45",
				"Currency" => $payment["currency_type"],
				"PaymentMethod" => $payment["payment_method"]->name,
				"PreviousBalanceAmount" => $this->numberInvoice($row["previous_balance"], 2),
				"AmountPaid" => $this->numberInvoice($row["amount"], 2),
				"ImpSaldoInsoluto" => $this->numberInvoice($row["pending_amount"], 2),
				"Taxes" => [
					[
						"Name" => "IVA",
						"Rate" => "0.16",
						"Total" => $this->numberInvoice(floatval($row["amount"]) / 1.16*0.16, 2),
						"Base" => $this->numberInvoice(floatval($row["amount"]) / 1.16, 2),
						"IsRetention" => "false",
					],
				]
			];
		}
		$result = [
			"NameId" => "14",
			"Currency" => $payment["currency_type"],
			"Folio" => $payment["folio"],
			"CfdiType" => "P",
			//"OrderNumber" => $order->id,
			"ExpeditionPlace" => $this->isProduction ? $this->config->zipcode : "78000",
			"Date" => date("Y-m-d\TH:i:s-06:00"),
			"Exportation" => "01",
			"Receiver" => [
				'Rfc' => $payment["client"]->rfc,
				'CfdiUse' => "CP01",
				'Name' => $payment["client"]->company_name,
				'FiscalRegime' => $payment["client"]->regime->name,
				'TaxZipCode' => $payment["client"]->zipcode,
			],
			"Complemento" => [
				"Payments" => [
					[
						"Date" => $payment["payment_date"],
						"PaymentForm" => $payment["payment_type"]->name,
						"Amount" => $this->numberInvoice($payment["total"], 2),
						"OperationNumber" => "1",
						"RelatedDocuments" => $relatedDocuments,
					],
				],
			],
		];

		return $result;
	}

	public function getCreditNote($credit_note)
	{
		$result = [
			"NameId" => "2",
			"Currency" => $credit_note["currency_type"],
			"Folio" => $credit_note["folio"],
			//"Serie" => "NDC",
			"CfdiType" => "E",
			"PaymentForm" => $credit_note["payment_type"]->name,
			"PaymentMethod" => $credit_note["payment_method"]->name,
			"OrderNumber" =>  $credit_note["order_number"],
			"ExpeditionPlace" => $this->isProduction ? $this->config->zipcode : "78000",
			"Date" => date("Y-m-d\TH:i:s-06:00"),
			"PaymentConditions" => "Nota de credito",
			"Exportation" => "01",
			"Receiver" => [
				'Rfc' => $credit_note["client"]->rfc,
				'CfdiUse' => "G02",
				'Name' => $credit_note["client"]->company_name,
				'FiscalRegime' => $credit_note["client"]->regime->name,
				'TaxZipCode' => $credit_note["client"]->zipcode,
			],
			"Relations" => [
				"Type" => "03",
				"Cfdis" => [
					[
						"Uuid" => $credit_note["relation"],
					]
				]
			],
			"Items" => [
				[
					"TaxObject" =>"02",
					"Quantity" => "1",
					"ProductCode" => "84111506",
					"UnitCode" => "ACT",
					"Unit" => "Actividad",
					"Description" => "DESCUENTO GENERALIZADO",
					//"IdentificationNumber" => "980000",
					"UnitPrice" => $this->numberInvoice($credit_note["total_base"]),
					"Subtotal" => $this->numberInvoice($credit_note["total_base"]),
					"Taxes" => [
						[
							"Name" => "IVA",
							"Rate" => "0.16",
							"Total" => $this->numberInvoice($credit_note["iva"]),
							"Base" => $this->numberInvoice($credit_note["total_base"]),
							"IsRetention" => "false",
							"IsFederalTax" => "false",
						]
					],
					"Total" => $this->numberInvoice($credit_note["total"]),
				],
			]
		];

		return $result;
	}
}