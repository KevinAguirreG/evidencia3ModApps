<?php
namespace App\Http\Controllers\API;

use App\Traits\QueryFilters;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
	use QueryFilters;

	public $defaultParams;

	public function __construct()
	{
		$this->defaultParams = [
			'created_by' => auth()->id(),
			'updated_by' => auth()->id(),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		];
	}
}