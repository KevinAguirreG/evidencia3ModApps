<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
	use HasFactory;
	
	protected $table = 'deliveries';
	protected $fillable = ['destiny_id', 'delivery_status_id', 'date', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function deliveryStatus()
	{
		return $this->belongsTo('App\Models\DeliveryStatus', 'delivery_status_id');
	}
	public function destinity()
	{
		return $this->belongsTo('App\Models\Destinity', 'destiny_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function confirmation()
	{
		return $this->hasOne('App\Models\Confirmation');
	}
	
	public function deliveryRows()
	{
		return $this->hasMany('App\Models\DeliveryRow');
	}
	
	public function deliveryFiles()
	{
		return $this->hasMany('App\Models\DeliveryFile');
	}
	
}