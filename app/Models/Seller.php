<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Seller extends Model
{
	use HasFactory;
	
	protected $table = 'sellers';
	protected $fillable = ['name', 'company_name', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function buyings()
	{
		return $this->hasMany('App\Models\Buying');
	}
	public static function getSeller()
	{
		return static::select('id', DB::raw("CONCAT_WS(' ', name ',', company_name) as value"));
	}
}