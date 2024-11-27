<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
			'name' => 'required|max:255',
			'folio' => 'required|max:255',
			'company_name' => 'required|max:255',
			'rfc' => 'required|max:255',
			'regime_id' => 'required',
			'tax_address' => 'required|max:255',
			'cfdi_use_id' => 'required',
			'notes' => 'max:1024',
			
		];
	}
}