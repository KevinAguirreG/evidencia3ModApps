<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryFileRequest extends FormRequest
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
			'description' => 'max:45',
			'file_path' => 'required|max:4096',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'delivery_id' => __('delivery_files.delivery_id'),
			'description' => __('delivery_files.description'),
			'file_path' => __('delivery_files.file_path'),
			'notes' => __('delivery_files.notes'),
			
		];
	}
}