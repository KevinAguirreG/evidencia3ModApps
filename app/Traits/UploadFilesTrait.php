<?php
namespace App\Traits;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadFilesTrait
{
	public function uploadFile($file, $path = null, $name = null, $type = 'file', $disk = 'public')
	{
		$result = '';
		$name = ($name ?? Str::random(25));
		switch ($type) {
			case 'file':
				$name .= '.'.$file->getClientOriginalExtension();
				$result = $file->storeAs($path, $name, $disk);
				$name = $path."/".$name;
				break;
			case 'base64':
				$ext = explode('/', mime_content_type($file))[1];
				$file = base64_decode(substr($file, strpos($file, ',') + 1));
				$name = $path."/".$name.'.'.$ext;
				$result = Storage::disk($disk)->put($name, $file);
				break;
		}
		return $name;
	}
}