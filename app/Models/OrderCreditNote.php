<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCreditNote extends Model
{
	use HasFactory;
	
	protected $table = 'order_credit_notes';
	protected $fillable = ['folio', 'order_stamp_id', 'client_id', 'payment_type_id', 'payment_method_id', 'currency_type', 'facturama_id', 'uuid', 'stamp_date', 'cfd_seal', 'sat_certificate', 'sat_seal', 'xml', 'total_base', 'iva', 'total', 'cancel_date', 'original_string', 'previous_balance', 'pending_amount', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'client_id');
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
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
}