<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
	use HasFactory;
	
	protected $table = 'order_payments';
	protected $fillable = ['folio', 'client_id', 'payment_type_id', 'payment_method_id', 'currency_type', 'payment_date', 'facturama_id', 'uuid', 'stamp_date', 'cfd_seal', 'sat_certificate', 'sat_seal', 'xml', 'total', 'cancel_date', 'original_string', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'client_id');
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

	public function paymentRows()
	{
		return $this->hasMany('App\Models\OrderPaymentRow');
	}
	
	public function getPaymentsFolio()
	{
		$last = $this->orderBy('folio', 'DESC')->first();
		return intval((($last ?? false) ? floatval($last->folio) : 0)+1);
	}
}