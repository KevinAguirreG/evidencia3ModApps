<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
			// 'destiny_id' => 'required',
			//'delivery_status_id' => 'required',
			'date' => 'required',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'destiny_id' => __('deliveries.destiny_id'),
			'delivery_status_id' => __('deliveries.delivery_status_id'),
			'date' => __('deliveries.date'),
			'notes' => __('deliveries.notes'),
			
		];
	}
}