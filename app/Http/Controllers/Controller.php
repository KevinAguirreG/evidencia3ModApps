<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Traits\QueryFilters;
use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Support\Facades\Storage;
use App\Classes\DomDocumentIdent;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function getQueryWithParams($query)
	{
		return vsprintf(str_replace('?', '%s', str_replace('%', '%%', $query->toSql())), collect($query->getBindings())->map(function ($binding) {
			return is_numeric($binding) ? $binding : "'{$binding}'";
		})->toArray());
	}

	public function getErrorMessage($e, $translations)
	{
		if($e->getCode() == "23000") {
			$error = __($translations.'.delete_error_message_constraint');
		}
		else {
			$error = __($translations.'.delete_error_message');
		}
		
		return $error.'. <br>
			<a href="#" data-bs-toggle="collapse" data-bs-target="#errorDetails">'.__('Show details').':</a>
			<span id="errorDetails" class="collapse" aria-expanded="false">'.$e->getMessage().'</span>';
	}

	/**
	 * [getResponse] Format the response depending of the type of request
	 *
	 * @param [bool]  $status		[True or false]
	 * @param string  $message		Description of the status
	 * @param [type]  $data			[json request] Attach this data to the response
	 * @param [Route] $route		[web request] Redirect to the given route else search for the index route for the current entity
	 * @param boolean $console		If the response is for console don't format as json and don't make a redirect
	 * @return void
	 */
	public function getResponse($status, $message, $data = null, $route = null, $console = false)
	{
		if(request()->expectsJson()) {
			$response = ["status" => $status, "message" => $message];
			if($data !== null) {
				$response["data"] = $data;
			}
			$result = response()->json($response, 200);
		} elseif ($console == false) {
			session()->flash($status ? 'message' : 'error', $message);

			if ($route == null) {
				$result = redirect()->route((explode(".", request()->route()->getName()))[0].".index");
			} else {
				$result = $route;
			}
		} else {
			$result = compact('status', 'message');
		}

		return $result;
	}

	public function downloadFile($content, $filename = "download.txt", $type = "txt")
	{
		Storage::disk('public')->put("downloads/".$filename, $content);
		return response()->file(public_path("downloads/".$filename) , ['Content-Type' => 'application/'.$type]);
	}

	public function prettyXML($xml)
	{
		$dom = new DomDocumentIdent('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml);
		$dom->xmlIndent();
		return $dom->saveXML();
	}

	public function getDatatableDefinition($dt, $newRoute)
	{
		$dataTable = $dt->html();
		$s = $dt->html()->scripts();
		$url = str_replace("/", "/", config('app.url')."/");

		//Replace route entity
		$dtScripts = substr($s, 0, strpos($s, '"url":"')+7).($url.$newRoute).substr($s, strpos($s, '","type"'), strlen($s));

		return compact('dataTable', 'dtScripts');
	}
}
