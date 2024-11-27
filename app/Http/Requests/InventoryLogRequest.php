<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryLogRequest extends FormRequest
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
			'product_id' => 'required',
			'inventory_id' => 'required',
			'move_date' => 'required',
			'amount' => 'required',
			'delta_amount' => 'required',
			'movement_type_id' => 'required',
			'notes' => 'max:1024',
			
		];
	}
}