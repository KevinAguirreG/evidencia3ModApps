<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRowRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'order_id' => 'required',
			'product_id' => 'required',
			'product_code' => 'required|max:255',
			'line' => 'required|max:255',
			'stock_number' => 'required|max:255',
			'color' => 'required|max:255',
			'size' => 'required|max:255',
			'amount' => 'required',
			'uom' => 'required|max:255',
			'package' => 'required|max:255',
			'cost' => 'required',
			'cost_total' => 'required',
			'notes' => 'max:1024',
			
		];
	}
}