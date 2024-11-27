<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SatDataRequest extends FormRequest
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
			'number' => 'max:45',
			'code' => 'max:12',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'description' => __('sat_datas.description'),
			'number' => __('sat_datas.number'),
			'code' => __('sat_datas.code'),
			'notes' => __('sat_datas.notes'),
			
		];
	}
}