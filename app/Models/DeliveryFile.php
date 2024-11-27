<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryFile extends Model
{
	use HasFactory;
	
	protected $table = 'delivery_files';
	protected $fillable = ['delivery_id', 'description', 'file_path', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function delivery()
	{
		return $this->belongsTo('App\Models\Delivery', 'delivery_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
}