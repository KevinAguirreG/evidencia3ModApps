<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloudDirRequest extends FormRequest
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
			// 'user_id' => 'required',
			'name' => 'required|max:45',
			// 'url' => 'required|max:255',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'cloud_dir_id' => __('cloud_dirs.cloud_dir_id'),
			'user_id' => __('cloud_dirs.user_id'),
			'name' => __('cloud_dirs.name'),
			'url' => __('cloud_dirs.url'),
			'notes' => __('cloud_dirs.notes'),
			
		];
	}
}