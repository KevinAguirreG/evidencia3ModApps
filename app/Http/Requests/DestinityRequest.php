<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinityRequest extends FormRequest
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
	public function rules(): array
	{
		return [
			'description' => 'max:255',
			'name' => 'required|max:45',
			'orders_quantity' => 'required',
			'warehouse_id' => 'required',
			'address' => 'max:255',
			'telephone' => 'max:12',
			'contact' => 'max:255',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'description' => __('destinities.description'),
			'name' => __('destinities.name'),
			'orders_quantity' => __('destinities.orders_quantity'),
			'warehouse_id' => __('destinities.warehouse_id'),
			'address' => __('destinities.address'),
			'telephone' => __('destinities.telephone'),
			'contact' => __('destinities.contact'),
			'notes' => __('destinities.notes'),
			
		];
	}
}