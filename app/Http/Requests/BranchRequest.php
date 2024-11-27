<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
			'client_id' => 'required',
			'branch_number' => 'required|max:255',
			'name' => 'required|max:255',
			'gln' => 'required|max:255',
			'address' => 'required|max:255',
			'city' => 'required|max:255',
			'notes' => 'max:1024',
			
		];
	}
}