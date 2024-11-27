<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	use HasFactory;
	
	protected $table = 'warehouses';
	protected $fillable = ['name', 'description', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function destinities()
	{
		return $this->hasMany('App\Models\Destinity');
	}
	
}