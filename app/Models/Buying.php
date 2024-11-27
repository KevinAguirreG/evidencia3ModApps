<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buying extends Model
{
	use HasFactory, SoftDeletes;
	
	protected $table = 'buyings';
	protected $fillable = ['date', 'seller_id', 'buying_status_id', 'subtotal', 'iva', 'total', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function seller()
	{
		return $this->belongsTo('App\Models\Seller', 'seller_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function buyingRows()
	{
		return $this->hasMany('App\Models\BuyingRow');
	}
	
}