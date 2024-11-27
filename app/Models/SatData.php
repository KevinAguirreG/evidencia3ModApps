<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatData extends Model
{
	use HasFactory;
	
	protected $table = 'sat_datas';
	protected $fillable = ['description', 'number', 'code', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}
}