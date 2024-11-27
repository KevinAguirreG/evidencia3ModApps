<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryStatusesRequest extends FormRequest
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
			'name' => 'required|max:255',
			'description' => 'max:255',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'name' => __('delivery_statuses.name'),
			'description' => __('delivery_statuses.description'),
			'notes' => __('delivery_statuses.notes'),
			
		];
	}
}