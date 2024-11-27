<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinyRequest extends FormRequest
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
			'description' => __('destinies.description'),
			'name' => __('destinies.name'),
			'orders_quantity' => __('destinies.orders_quantity'),
			'warehouse_id' => __('destinies.warehouse_id'),
			'address' => __('destinies.address'),
			'telephone' => __('destinies.telephone'),
			'contact' => __('destinies.contact'),
			'notes' => __('destinies.notes'),
			
		];
	}
}