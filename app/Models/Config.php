<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	use HasFactory;
	
	protected $table = 'configs';
	protected $fillable = ['company_name', 'rfc', 'zipcode', 'regime_id', 'address', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

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
	
}