<?php

namespace App\Http\Controllers;


use App\Http\Requests\DeliveryRowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CloudController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
        return view("clouds.index");
	}


}
