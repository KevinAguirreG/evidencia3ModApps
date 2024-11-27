<?php

namespace App\Http\Controllers;

use App\Models\CloudDir;
use App\Models\CloudFile;

use App\Http\Requests\CloudFileRequest;
use App\DataTables\CloudFileDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CloudFileController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$cloud_dir = CloudDir::where('id', 2)->first();
		//Consultar permiso para botón de agregar
		$allowAdd = auth()->user()->hasPermissions("cloud_files.create");
		$allowEdit = auth()->user()->hasPermissions("cloud_files.edit");
		return (new CloudFileDataTable())->render('cloud-files.index', compact('allowAdd', 'allowEdit', 'cloud_dir'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		
		return view('cloud-files.create', compact('cloudDirs'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CloudFileRequest $request)
	{
		$status = true;
		$cloud_file = null;
		$params = array_merge($request->all(), [
			'created_by' => auth()->id(),
			'updated_by' => auth()->id(),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		try {
			$cloud_file = CloudFile::create($params);
			$message = __('cloud_files.Successfully created');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_files');
		}
		return $this->getResponse($status, $message, $cloud_file);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\CloudFile  $cloud_file
	 * @return \Illuminate\Http\Response
	 */
	public function show(CloudFile $cloud_file)
	{
		return view('cloud-files.show', compact('cloud_file'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\CloudFile  $cloud_file
	 * @return \Illuminate\Http\Response
	 */
	public function edit(CloudFile $cloud_file)
	{
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		
		return view('cloud-files.edit', compact('cloud_file','cloudDirs'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\CloudFile  $cloud_file
	 * @return \Illuminate\Http\Response
	 */
	public function update(CloudFileRequest $request, CloudFile $cloud_file)
	{
		$status = true;
		$params = array_merge($request->all(), [
			'updated_by' => auth()->id(),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		try {
			$cloud_file->update($params);
			//Le cambiamos el nombre en el directorio
			$message = __('cloud_files.Successfully updated');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_files');
		}
		return $this->getResponse($status, $message, $cloud_file);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\CloudFile  $cloud_file
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(CloudFile $cloud_file)
	{
		$status = true;
		try {
			Storage::delete($cloud_file->file_path);
			$cloud_file->delete();
			$message = __('cloud_files.Successfully deleted');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_files');
		}
		return $this->getResponse($status, $message);
	}

	public function getQuickModalContent(CloudFile $cloud_file = null)
	{
		$params = request("params");
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		
		return response()->json(view('crud-maker.components.modal-quickadd', compact('params', 'cloud_file','cloudDirs'))->render());
	}

	public function splitName($name){
		$result = [];

		
		$extension = explode('.',$name);
		$extension = end($extension);
		$nameWoExtension = str_replace('.'.$extension, '', $name);
		$result = ["name" => $nameWoExtension, "extension" => $extension];
		return $result;
	}

	public function downloadCloudFile( $cloud_file ){
 
		$file = CloudFile::find($cloud_file);
		return Storage::download($file->file_path,  $file->description.".".$file->extension);
	}
}
