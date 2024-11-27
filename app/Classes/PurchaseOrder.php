<?php
namespace App\Classes;

use Illuminate\Support\Facades\Route as RouteBase;
use Illuminate\Support\Str;

use Smalot\PdfParser\Parser;
use Aspose\Words\WordsApi;
use Spatie\PdfToText\Pdf;

class PurchaseOrder
{
	public function getValue($name, $start, $end, $data, $result)
	{
		if (gettype($start) == "string") {
			$start = strpos($data, $start)+strlen($start);
		}
		if (gettype($end) == "string") {
			$end = strpos(substr($data, $start, strlen($data)), $end);
		}
		$result[$name] = str_replace("\r\n", " ", trim(substr($data, $start, $end)));
		$data = substr($data, $start+$end, strlen($data));
		$data = trim($data);
		return compact('data', 'result');
	}

	public function getCol($name, $key, $data, $result)
	{
		if (gettype($key) == "array") {
			$result[$name] = "";
			foreach ($key as $key => $value) {
				$result[$name] .= $data[$value]. " ";
				unset($data[$value]);
			}
		} else {
			$result[$name] = $data[$key];
			unset($data[$key]);
		}
		$result[$name] = trim($result[$name]);
		return compact('data', 'result');
	}

	public function cleanArray($param)
	{
		$result = explode("\r\n", $param);
		//Remove first key if it is only a break line
		$k = 0;
		if (strlen($result[$k]) <= 1) {
			unset($result[$k]);
		}
		//Remove last key if it is only a break line
		$k = array_key_last($result);
		if (strlen($result[$k]) <= 1) {
			unset($result[$k]);
		}

		//dd($result);
		foreach ($result as $key => $row) {
			$r = explode(" ", $row);
			if (strlen($r[0]) != 3) {
				$result[$key-1] .= " ".$row;
				unset($result[$key]);
			}
		}
		return $result;
	}
}