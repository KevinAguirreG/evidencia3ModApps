<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloudFileRequest extends FormRequest
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
			// 'cloud_dir_id' => 'required',
			'description' => 'max:45',
			// 'file_path' => 'required|max:255',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'cloud_dir_id' => __('cloud_files.cloud_dir_id'),
			'description' => __('cloud_files.description'),
			'file_path' => __('cloud_files.file_path'),
			'notes' => __('cloud_files.notes'),
			
		];
	}
}