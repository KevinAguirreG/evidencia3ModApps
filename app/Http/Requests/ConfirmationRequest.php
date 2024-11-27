<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmationRequest extends FormRequest
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
			'confirmation_number' => 'required|max:45',
			'date' => 'required',
			'time' => 'required',
			'xls' => 'max:4096',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'delivery_id' => __('confirmations.delivery_id'),
			'confirmation_number' => __('confirmations.confirmation_number'),
			'date' => __('confirmations.date'),
			'time' => __('confirmations.time'),
			'xls' => __('confirmations.xls'),
			'notes' => __('confirmations.notes'),
			
		];
	}
}