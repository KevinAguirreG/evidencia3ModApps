<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRow extends Model
{
	use HasFactory;
	
	protected $table = 'delivery_rows';
	protected $fillable = ['delivery_id', 'order_id', 'cedis', 'cancel_date', 'amount', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function delivery()
	{
		return $this->belongsTo('App\Models\Delivery', 'delivery_id');
	}
	public function order()
	{
		return $this->belongsTo('App\Models\Order', 'order_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
}