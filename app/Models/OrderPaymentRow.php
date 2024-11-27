<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaymentRow extends Model
{
	use HasFactory;
	
	protected $table = 'order_payment_rows';
	protected $fillable = ['order_payment_id', 'order_stamp_id', 'payment_type_id', 'payment_method_id', 'currency_type', 'partiality_number', 'previous_balance', 'total', 'pending_amount', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function payment()
	{
		return $this->belongsTo('App\Models\OrderPayment', 'order_payment_id');
	}
	public function stamp()
	{
		return $this->belongsTo('App\Models\OrderStamp', 'order_stamp_id');
	}
	public function paymentMethod()
	{
		return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
	}
	public function paymentType()
	{
		return $this->belongsTo('App\Models\PaymentType', 'payment_type_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function getPartialityNumber($order_id)
	{
		$last = $this
			->leftjoin('order_stamps', 'order_payment_rows.order_stamp_id', '=', 'order_stamps.id')
			->where('order_stamps.order_id', $order_id)
			->orderBy('order_payment_rows.partiality_number', 'DESC')->first();
		return intval((($last ?? false) ? floatval($last->partiality_number) : 0)+1);
	}
	
}