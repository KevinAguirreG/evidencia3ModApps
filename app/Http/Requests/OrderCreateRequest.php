<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
			'payment_type_id' => 'required',
			'payment_method_id' => 'required',
			'branch_code' => 'required|max:255',
			'order' => 'required',
			// 'order_header' => 'required',
			// 'order_content' => 'required',
		];
	}

	public function attributes(){
		return [
			'client_id' => __('orders.client_id'),
			'payment_type_id' => 'required',
			'payment_method_id' => 'required',
			'branch_code' => __('orders.branch_code'),
			'order' => __('orders.order'),
		];
	}
}