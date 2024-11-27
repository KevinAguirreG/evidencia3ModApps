<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStamp extends Model
{
	use HasFactory;
	
	protected $table = 'order_stamps';
	protected $fillable = ['order_id', 'facturama_id', 'response_id', 'contract', 'uuid', 'stamp_date', 'cfd_seal', 'sat_certificate', 'sat_seal', 'xml', 'total', 'cancel_date', 'original_string', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function order()
	{
		return $this->belongsTo('App\Models\Order', 'order_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function payments()
	{
		return $this->hasMany('App\Models\OrderPaymentRow');
	}
	
	public function creditNotes()
	{
		return $this->hasMany('App\Models\OrderCreditNote');
	}
	
	public function getcreditNotesFolio()
	{
		$last = (new OrderCreditNote)->orderBy('folio', 'DESC')->first();
		return intval((($last ?? false) ? floatval($last->folio) : 0)+1);
	}
}