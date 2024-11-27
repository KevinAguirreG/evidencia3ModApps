<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudFile extends Model
{
	use HasFactory;
	
	protected $table = 'cloud_files';
	protected $fillable = ['cloud_dir_id', 'description', 'file_path', 'extension', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

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
	
}