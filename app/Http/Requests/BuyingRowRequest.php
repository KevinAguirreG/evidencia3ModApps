<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyingRowRequest extends FormRequest
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
		$result = [];
		if(!request()->hasFile('document')){
			$result = [
				'buying_id' => 'required',
				'product_id' => 'required',
				'barcode' => 'required|max:255',
				'zamexco_code' => 'required|max:255',
				'amount' => 'required',
				'price' => 'required',
				'total' => 'required',
				'notes' => 'max:1024',
			];
		}
		return $result;
	}
}