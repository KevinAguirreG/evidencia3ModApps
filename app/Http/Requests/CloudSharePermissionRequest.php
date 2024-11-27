<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloudSharePermissionRequest extends FormRequest
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
			'cloud_dir_id' => 'required',
			'user_id' => 'required',
			'delete_permission' => 'required',
			'upload_permission' => 'required',
			'notes' => 'max:1024',
			
		];
	}

	public function attributes(): array
	{
		return [
			'cloud_dir_id' => __('cloud_share_permissions.cloud_dir_id'),
			'user_id' => __('cloud_share_permissions.user_id'),
			'delete_permission' => __('cloud_share_permissions.delete_permission'),
			'upload_permission' => __('cloud_share_permissions.upload_permission'),
			'notes' => __('cloud_share_permissions.notes'),
			
		];
	}
}