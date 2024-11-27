<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinity extends Model
{
	use HasFactory;
	
	protected $table = 'destinities';
	protected $fillable = ['description', 'name', 'orders_quantity', 'warehouse_id', 'address', 'telephone', 'contact', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	public function warehouse()
	{
		return $this->belongsTo('App\Models\Warehouse', 'warehouse_id');
	}
	
	public function deliveries()
	{
		return $this->hasMany('App\Models\Delivery');
	}
	
}