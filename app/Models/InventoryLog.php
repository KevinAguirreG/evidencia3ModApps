<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
	use HasFactory;
	
	protected $table = 'inventory_logs';
	protected $fillable = ['product_id', 'inventory_id', 'move_date', 'amount', 'delta_amount', 'movement_type_id', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function inventory()
	{
		return $this->belongsTo('App\Models\Inventory', 'inventory_id');
	}
	public function movementType()
	{
		return $this->belongsTo('App\Models\MovementType', 'movement_type_id');
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