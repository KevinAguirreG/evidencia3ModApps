<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	use HasFactory;
	
	protected $table = 'product_prices';
	protected $fillable = ['product_id', 'client_id', 'price', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'client_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
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