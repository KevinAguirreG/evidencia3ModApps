<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRowRequest extends FormRequest
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
			'delivery_id' => 'required',
			'order_id' => 'required',
			'cedis' => 'required|max:45',
			'order_date' => 'required',
			'delivery_date' => 'required',
			'amount' => 'required',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'delivery_id' => __('delivery_rows.delivery_id'),
			'order_id' => __('delivery_rows.order_id'),
			'cedis' => __('delivery_rows.cedis'),
			'order_date' => __('delivery_rows.order_date'),
			'delivery_date' => __('delivery_rows.delivery_date'),
			'cancel_date' => __('delivery_rows.cancel_date'),
			'amount' => __('delivery_rows.amount'),
			'notes' => __('delivery_rows.notes'),
			
		];
	}
}