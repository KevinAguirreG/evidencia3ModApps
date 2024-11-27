<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRow extends Model
{
	use HasFactory;
	
	protected $table = 'order_rows';
	protected $fillable = ['order_id', 'product_id', 'product_code', 'line', 'stock_number', 'color', 'size', 'amount', 'uom', 'package', 'cost', 'cost_total', 'product_number', 'provider_number', 'description', 'capacity', 'units_casepack', 'total_casepack', 'pieces', 'price_limit_date', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function order()
	{
		return $this->belongsTo('App\Models\Order', 'order_id');
	}
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
}