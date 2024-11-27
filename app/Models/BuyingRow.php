<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyingRow extends Model
{
	use HasFactory, SoftDeletes;
	
	protected $table = 'buying_rows';
	protected $fillable = ['buying_id', 'product_id', 'buying_status_id', 'barcode', 'zamexco_code', 'amount', 'price', 'total', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function buying()
	{
		return $this->belongsTo('App\Models\Buying', 'buying_id');
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