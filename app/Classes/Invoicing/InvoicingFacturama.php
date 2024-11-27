<?php
namespace App\Classes\Invoicing;

use App\Classes\BlankRequest;

class InvoicingFacturama extends BlankRequest
{
	public function __construct()
	{
		$this->baseUri = config('invoicing.facturama.uri');
		$this->setClient([
			'headers' => [
				'User-Agent' => 'Facturama-PHP-SDK-v2.0.1',
				'Accept' => 'application/json',
			],
			'auth' => [config('invoicing.facturama.username'), config('invoicing.facturama.password')],
			'connect_timeout' => 10,
			'timeout' => 60,
		]);
	}

	/**
	 * [decodeMessage] Esta función recibe la respuesta de facturama.
	 * Para convertir el array de errores en un string para mostrar al usuario
	 *
	 * @param array $r
	 * @return $result
	 */
	private function decodeMessage($r)
	{
		$result = $r;
		if (!$r["status"]) {
			$result["message"] = '';
			if ($r["message"]["ModelState"] ?? false) {
				foreach ($r["message"]["ModelState"] as $key => $value) {
					$result["message"] .= $key.': ';
					foreach ($value as $key => $v) {
						$result["message"] .= $v.',';
					}
					$result["message"] = substr($result["message"], 0, -1).".\n";
				}
			} else {
				$result["message"] = $r["message"]["Message"] ?? $r["message"];
			}
		}
		return $result;
	}

	/**
	 * [stamp] Timbrar factura
	 *
	 * @param array $data Contenido de la factura a timbrar
	 * @return array [status, message|data]
	 */
	public function stamp($data)
	{
		return $this->decodeMessage($this->post("3/cfdis", $data));
	}

	/**
	 * [payment] Timbrar complemento de pago
	 *
	 * @param array $data Contenido del complemento a timbrar
	 * @return array [status, message|data]
	 */
	public function payment($data)
	{
		return $this->decodeMessage($this->post("3/cfdis", $data));
	}

	/**
	 * [getXML] Consultar el archivo xml de una factura complemento timbrado
	 *
	 * @param int $id Identificador
	 * @return array [status, message|data]
	 */
	public function getXML($id)
	{
		return $this->get("Cfdi/xml/issued/{$id}");
	}

	/**
	 * [cancel] Cancelar factura
	 *
	 * @param int $id Identificador
	 * @return array [status, message|data]
	 */
	public function cancel($id)
	{
		$data = ["type" => "issued", "motive" => "02"];
		return $this->delete("Cfdi/{$id}", $data);
	}
}