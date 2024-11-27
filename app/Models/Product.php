<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;
	
	protected $table = 'products';
	protected $fillable = ['client_id', 'product_number', 'name', 'description', 'upc', 'packing_type', 'capacity', 'pieces', 'department_id', 'price', 'product_code', 'unit_code', 'unit', 'gtin_type', 'tax_id', 'tax_type', 'tax_rate', 'factor_type', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'client_id');
	}
	public function satData()
	{
		return $this->belongsTo('App\Models\SatData', 'sat_data_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function tax()
	{
		return $this->belongsTo('App\Models\Tax', 'tax_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function orderRows()
	{
		return $this->hasMany('App\Models\OrderRow');
	}
	
	public function prices()
	{
		return $this->hasMany('App\Models\ProductPrice');
	}

	public function getPriceByClient($clientId)
	{
		$price = $this->prices->where("client_id", $clientId)->first();
		return $price->price ?? 0;
	}
	
}