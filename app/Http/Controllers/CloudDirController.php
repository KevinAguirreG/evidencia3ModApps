<?php

namespace App\Http\Controllers;

use App\DataTables\CloudSharePermissionDataTable;
use App\Models\CloudDir;
use App\Models\CloudFile;
use App\Models\User;

use App\Http\Requests\CloudDirRequest;
use App\DataTables\CloudDirDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CloudDirController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = auth()->user();
		$this->createRootDirs($user);
		$rootDir = CloudDir::where("url", "userfiles/".$user->id."/root")->first();
		if(request()->has("search_folder")){
			$cloud_dirs = CloudDir::where('name', 'like', '%'.request('search_folder').'%')->where('cloud_dir_id', $rootDir->id)->paginate(12);
		}else{
			$cloud_dirs = CloudDir::where('cloud_dir_id', $rootDir->id)->paginate(12) ;
		}

		
		
		if(request()->has("search_shared_folder")){
			$sharedDirs = CloudDir::select('cloud_dirs.*')
                ->leftjoin('cloud_share_permissions', 'cloud_dirs.id', '=', 'cloud_share_permissions.cloud_dir_id')
				->where('cloud_share_permissions.user_id', $user->id)
				->where('cloud_dirs.name', 'like', '%'.request('search_shared_folder').'%')
				->paginate(12);			
		}else{
			$sharedDirs = CloudDir::select('cloud_dirs.*')
			->leftjoin('cloud_share_permissions', 'cloud_dirs.id', '=', 'cloud_share_permissions.cloud_dir_id')
			->where('cloud_share_permissions.user_id', $user->id)
			->paginate(12);
		}
		//Consultar permiso para botón de agregar
		$allowAdd = auth()->user()->hasPermissions("cloud_dirs.create");
		$allowEdit = auth()->user()->hasPermissions("cloud_dirs.edit");
	return (new CloudDirDataTable())->render('cloud-dirs.index', compact('allowAdd', 'allowEdit', 'rootDir', 'cloud_dirs', 'user','sharedDirs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		$users = User::orderBy('name', 'asc')->pluck('name', 'id');
		
		return view('cloud-dirs.create', compact('cloudDirs','users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CloudDirRequest $request)
	{
		$status = true;
		$cloud_dir = null;
		$fatherDir = CloudDir::where('id', $request->cloud_dir_id)->first();
		$params = array_merge($request->all(), [
			'created_by' => auth()->id(),
			'updated_by' => auth()->id(),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		try {
			$cloud_dir = CloudDir::create($params);
			$cloud_dir->url = $fatherDir->url.'/'.$cloud_dir->id;
			$cloud_dir->save();
			$this->createDirInStorage($cloud_dir);
			$message = __('cloud_dirs.Successfully created');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_dirs');
		}
		return $this->getResponse($status, $message, $cloud_dir);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\CloudDir  $cloud_dir
	 * @return \Illuminate\Http\Response
	 */
	public function show(CloudDir $cloud_dir)
	{

		$user = auth()->user();
		$sharedPermissions = $this->getPermissionsRecursive($cloud_dir);
		// $sharedPermissions= $user->CloudSharePermissions->where('cloud_dir_id',$cloud_dir->id)->first(); 
		if(request()->has("search")){
			$cloud_dirs = CloudDir::where('name', 'like', '%'.request('search').'%')->where('cloud_dir_id', $cloud_dir->id)->paginate(12);
			$cloud_files = CloudFile::where('description', 'like', '%'.request('search').'%')->where('cloud_dir_id', $cloud_dir->id)->paginate(12);
		}else{
			$cloud_dirs = $cloud_dir->CloudDirs;
			$cloud_files = $cloud_dir->CloudFiles;
		}
		
		//Consultar permiso para botón de agregar
		$allowAdd = auth()->user()->hasPermissions("cloud_dirs.create");
		$allowEdit = auth()->user()->hasPermissions("cloud_dirs.edit");

		$cloudFilesAllowAdd = auth()->user()->hasPermissions("cloud_files.create");
		$cloudFilesAllowEdit = auth()->user()->hasPermissions("cloud_files.edit");
		

		return view('cloud-dirs.show', compact('cloud_dir', 'allowAdd', 'allowEdit','cloudFilesAllowAdd', 'cloudFilesAllowEdit', 'user', 'sharedPermissions', 'cloud_dirs', 'cloud_files'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\CloudDir  $cloud_dir
	 * @return \Illuminate\Http\Response
	 */
	public function edit(CloudDir $cloud_dir)
	{
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		$users = User::orderBy('name', 'asc')->pluck('name', 'id');
		
		return view('cloud-dirs.edit', compact('cloud_dir','cloudDirs','users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\CloudDir  $cloud_dir
	 * @return \Illuminate\Http\Response
	 */
	public function update(CloudDirRequest $request, CloudDir $cloud_dir)
	{
		$status = true;
		$params = array_merge($request->all(), [
			'updated_by' => auth()->id(),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		try {
			$cloud_dir->update($params);
			$message = __('cloud_dirs.Successfully updated');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_dirs');
		}
		return $this->getResponse($status, $message, $cloud_dir);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\CloudDir  $cloud_dir
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(CloudDir $cloud_dir)
	{
		$status = true;
		try {
			Storage::deleteDirectory($cloud_dir->url);
			$cloud_dir->delete();
			$message = __('cloud_dirs.Successfully deleted');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_dirs');
		}
		return $this->getResponse($status, $message);
	}

	public function getQuickModalContent(CloudDir $cloud_dir = null)
	{
		$user = auth()->user();
		
		$params = request("params");
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		$users = User::orderBy('name', 'asc')->pluck('name', 'id');
		
		return response()->json(view('crud-maker.components.modal-quickadd', compact('params', 'cloud_dir','cloudDirs','users', 'user'))->render());
	}

	public function getPermissionsRecursive( $cloud_dir)
	{
		$result = false;
		$permission = $cloud_dir->cloudSharePermissions ?? null;
		if($permission != null){
			$permission = $permission->where('user_id', auth()->user()->id);
			if($permission->isNotEmpty()){
				$result = $permission->first();
			}else{
				if($cloud_dir->cloudDir){
					$result = $this->getPermissionsRecursive($cloud_dir->CloudDir);
				}else{
					$result = false;
				}
			}
		}else{
			$result = false;
		}
		return $result;
	}

	public function getCreateFolderModal($father_id = null)
	{
		$user = auth()->user();
		$cloud_dir = null;
		$fatherDir = null;

		if($father_id != null){
			$fatherDir = CloudDir::where("id", $father_id)->first();
		}

		// if($cloud_dir != $rootDir){
		// 	$fatherDir = $cloud_dir;
		// 	$cloud_dir = null;

		// }else{
		// 	$fatherDir = $rootDir;
		// 	$cloud_dir = null;

		// }
		$params = request("params");
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		$users = User::orderBy('name', 'asc')->pluck('name', 'id');
		
		return response()->json(view('crud-maker.components.modal-quickadd', compact('params','cloudDirs','users', 'fatherDir', 'user', 'cloud_dir'))->render());
	}

	public function getSharePermissionsModal(CloudDir $cloud_dir)
	{
		$user = auth()->user();
		$params = request("params");
		$cloud_dir = CloudDir::find($params["id"]);
		$cloudSharePermissions = extract($this->getDatatableDefinition(new CloudSharePermissionDataTable(), "cloud_share_permissions/getdatatable/".$cloud_dir->id));


		$cloudPermissionsDataTable = 
		$dt = new CloudSharePermissionDataTable($cloud_dir->id);
		$sharePermissionsDataTable = $dt->html();
		$s = $dt->html()->scripts();
        $url = str_replace("/", "/", config('app.url')."/");
        $pos1 = strpos($s, '{"url":"');
        $pos2 = strpos($s, '","type"');
        $dtScripts = substr($s, 0, $pos1+8).$url."cloud_share_permissions/getdatatable/".$cloud_dir->id.substr($s, $pos2, strlen($s));


		$sharePermissionsEdit = auth()->user()->hasPermissions('cloud_share_permissions.edit');
		$sharePermissionsAdd = auth()->user()->hasPermissions('cloud_share_permissions.create');
		
		// dd($dataTable->table(["width" => "100%"]));

		dd(response()->json(view('cloud-dirs.modal-share-permissions', compact('params', 'user', 'cloud_dir', 'sharePermissionsDataTable', 'dtScripts', 'sharePermissionsEdit', 'sharePermissionsAdd'))));
		return response()->json(view('cloud-dirs.modal-share-permissions', compact('params', 'user', 'cloud_dir', 'sharePermissionsDataTable', 'dtScripts', 'sharePermissionsEdit', 'sharePermissionsAdd'))->render());
	}

	public function createRootDirs($user){
		$status = true;
		$directory = "userfiles/".$user->id."/root";
		$message = "";
		try {
			if( empty(Storage::directories("userfiles/".$user->id))){
				CloudDir::create([
					"user_id" => $user->id,
					"name" => "root",
					"url" => $directory,
					'created_by' => auth()->id(),
					'updated_by' => auth()->id(),
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s")
				]);
				Storage::makeDirectory($directory);
				$message = __('cloud_dirs.Base dir successfully created');
			
			}
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_dirs');
		}
		return [$status, $message];
	}

	public function createDirInStorage(CloudDir $dir){
		$status = true;
		
		$message = "";
		try {
			Storage::makeDirectory($dir->url);
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_dirs');
		}
		return [$status, $message];
	}

	public function fileStore(Request $request) { 

		$cloud_dir = CloudDir::where("id", $request->cloud_dir_id)->first();
		
		//Almacenamos el archivo en nuestro storage
		foreach($request->file('file') as $key => $file){
			$path = $file->store($cloud_dir->url);
			$nameExtension = app('App\Http\Controllers\CloudFileController')->splitName($file->getClientOriginalName());
			$name = $nameExtension["name"];
			$extension = $nameExtension["extension"];
			// $extension = explode('.',$file->getClientOriginalName());
			// $extension = end($extension);
			$params = [
				'cloud_dir_id' => $request->cloud_dir_id,
				'description' => $name,
				'file_path' => $path,
				'extension' => $extension,
				'created_by' => auth()->id(),
				'updated_by' => auth()->id(),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			];
			$cloud_file = CloudFile::create($params);
			$message = __('cloud_files.Successfully created');

		}

		return $message;
    }
}
