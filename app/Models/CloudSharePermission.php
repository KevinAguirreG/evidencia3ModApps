<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudSharePermission extends Model
{
	use HasFactory;
	
	protected $table = 'cloud_share_permissions';
	protected $fillable = ['cloud_dir_id', 'user_id', 'delete_permission', 'upload_permission', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function cloudDir()
	{
		return $this->belongsTo('App\Models\CloudDir', 'cloud_dir_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
	
}