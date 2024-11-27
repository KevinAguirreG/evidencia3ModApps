<?php
namespace App\Classes\Invoicing;

class InvoicingProdigia
{
	public function __construct()
	{
		$this->baseUri = "https://timbrado.pade.mx/servicio/rest/";
	}

	public function stamp($data)
	{
		$result = [];
		$params = ["contrato" => "52af7c06-c533-4696-9135-59ca954b8b98"];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->baseUri."timbrado40Prueba?".http_build_query($params));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/xml', 
			'Authorization: Basic d2Vicy56YW1leGNvQGVhc3lzd2ViLmNvbS5teDpaQE0zWEMwNjk=',
		]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		//$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$response = curl_exec($ch);
		$result = json_decode(json_encode((array) simplexml_load_string($response)), true);
		curl_close($ch);

		return $result;
	}
}