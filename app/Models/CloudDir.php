<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudDir extends Model
{
	use HasFactory;
	
	protected $table = 'cloud_dirs';
	protected $fillable = ['cloud_dir_id', 'user_id', 'name', 'url', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function cloudDir()
	{
		return $this->belongsTo('App\Models\CloudDir', 'cloud_dir_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
	
	public function cloudDirs()
	{
		return $this->hasMany('App\Models\CloudDir');
	}
	
	public function cloudFiles()
	{
		return $this->hasMany('App\Models\CloudFile');
	}
	
	public function cloudSharePermissions()
	{
		return $this->hasMany('App\Models\CloudSharePermission');
	}
	
}