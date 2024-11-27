<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	use HasFactory;
	
	protected $table = 'branches';
	protected $fillable = ['client_id', 'branch_number', 'name', 'gln', 'address', 'city', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'client_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
}