<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderPaymentRequest extends FormRequest
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
		if (request("order_id") ?? false) {
			$order = Order::find(request("order_id"));
		}
		return [
			'facturama_id' => 'max:255',
			'total' => 'required|numeric'.(request("order_id") ?? false ? '|between:0,'.$order->getPendingAmount() : ''),
			'notes' => 'max:1024',
		];
	}

	public function attributes(): array
	{
		return [
			'facturama_id' => __('order_payments.facturama_id'),
			'total' => __('order_payments.total'),
			'notes' => __('order_payments.notes'),
		];
	}
}