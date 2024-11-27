<?php
namespace App\Classes;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use GuzzleHttp\RequestOptions;

class BlankRequest
{
	/**
	 * URI from the webservice server
	 *
	 * @var string
	 */
	public $baseUri;

	/**
	 * Implement the http client
	 *
	 * @var \GuzzleHttp\Client
	 */
	public $client;

	/**
	 * Set the main params to the http client
	 *
	 * @param array $params
	 * @return void
	 */
	public function setClient($params)
	{
		$this->client = new GuzzleClient($params);
	}

	/**
	 * Set the structure for the params received to send in the http request
	 *
	 * @param array $p		Params
	 * @param string $t 	Type (json, body, query)
	 * @return array
	 */
	private function handleParams($p, $t)
	{
		return ($p != null ? [$t => $p] : []);
	}

	/**
	 * Execute the requesto to the server
	 *
	 * @param string $path			resource path route
	 * @param string $type			HTTP method
	 * @param array  $params		Aditional params to send in the request
	 * @param string $paramsType	Type (json, body, query)
	 * @return array [status, message|data]
	 */
	public function request($path, $type = "GET", $params, $paramsType)
	{
		$result = ["status" => true];
		try {
			$p = $this->handleParams($params, $paramsType);
			$response = $this->client->request($type, sprintf('%s/%s', $this->baseUri, $path), $p);
			$result["data"] = json_decode($response->getBody()->getContents(), true);
		} catch (GuzzleRequestException $e) {
			$result["status"] = false;
			$result["message"] = json_decode($e->getResponse()->getBody()->getContents(), true) ?? $e->getMessage();
		}

		return $result;
	}

	/**
	 * GET request
	 *
	 * @param string $path			resource path route
	 * @param array  $params		Aditional params to send in the request
	 * @param string $paramsType	Type (json, body, query)
	 * @return array [status, message|data]
	 */
	public function get($path, $params = [], $paramsType = 'query')
	{
		return $this->request($path, "GET", $params, $paramsType);
	}

	/**
	 * POST request
	 *
	 * @param string $path			resource path route
	 * @param array  $params		Aditional params to send in the request
	 * @param string $paramsType	Type (json, body, query)
	 * @return array [status, message|data]
	 */
	public function post($path, $params = null, $paramsType = 'json')
	{
		return $this->request($path, "POST", $params, $paramsType);
	}

	/**
	 * PUT request
	 *
	 * @param string $path			resource path route
	 * @param array  $params		Aditional params to send in the request
	 * @param string $paramsType	Type (json, body, query)
	 * @return array [status, message|data]
	 */
	public function put($path, $params = null, $paramsType = 'json')
	{
		return $this->request($path, "PUT", $params, $paramsType);
	}

	/**
	 * PATCH request
	 *
	 * @param string $path			resource path route
	 * @param array  $params		Aditional params to send in the request
	 * @param string $paramsType	Type (json, body, query)
	 * @return array [status, message|data]
	 */
	public function patch($path, $params = null, $paramsType = 'json')
	{
		return $this->request($path, "PATCH", $params, $paramsType);
	}

	/**
	 * DELETE request
	 *
	 * @param string $path			resource path route
	 * @param array  $params		Aditional params to send in the request
	 * @param string $paramsType	Type (json, body, query)
	 * @return array [status, message|data]
	 */
	public function delete($path, $params = [], $paramsType = 'query')
	{
		return $this->request($path, "DELETE", $params, $paramsType);
	}
}