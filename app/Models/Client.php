<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use HasFactory;
	
	protected $table = 'clients';
	protected $fillable = ['name', 'folio', 'zipcode', 'company_name', 'rfc', 'regime_id', 'tax_address', 'cfdi_use_id', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function cfdiUse()
	{
		return $this->belongsTo('App\Models\CfdiUse', 'cfdi_use_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function regime()
	{
		return $this->belongsTo('App\Models\Regime', 'regime_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function orders()
	{
		return $this->hasMany('App\Models\Order');
	}
	
	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}
	
	public function branches()
	{
		return $this->hasMany('App\Models\Branch');
	}
}