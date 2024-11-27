<?php

namespace App\Http\Controllers;

use App\Models\CloudDir;
use App\Models\CloudSharePermission;
use App\Models\User;

use App\Http\Requests\CloudSharePermissionRequest;
use App\DataTables\CloudSharePermissionDataTable;
use Illuminate\Http\Request;

class CloudSharePermissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//Consultar permiso para botón de agregar
		$allowAdd = auth()->user()->hasPermissions("cloud_share_permissions.create");
		$allowEdit = auth()->user()->hasPermissions("cloud_share_permissions.edit");
		return (new CloudSharePermissionDataTable())->render('cloud-share-permissions.index', compact('allowAdd', 'allowEdit'));
	}

	public function indexParam($cloud_dir = null)
	{
		if(request('parent') ?? false){
			$cloud_dir = CloudDir::find(request("parent"));
		}
		//Consultar permiso para botón de agregar
		$allowAdd = auth()->user()->hasPermissions("cloud_share_permissions.create");
		$allowEdit = auth()->user()->hasPermissions("cloud_share_permissions.edit");
		return (new CloudSharePermissionDataTable($cloud_dir->id))->render('cloud-share-permissions.index', compact('allowAdd', 'allowEdit', 'cloud_dir'));
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
		
		return view('cloud-share-permissions.create', compact('cloudDirs','users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CloudSharePermissionRequest $request)
	{
		$status = true;
		$cloud_share_permission = null;
		$cloud_dir = CloudDir::find($request->cloud_dir_id);
		$uniqueUser = true; 
		foreach($cloud_dir->cloudSharePermissions as $key => $permissions){
			if($permissions->user_id == $request->user_id){
				$uniqueUser = false;
			}
		}
		if($uniqueUser){
			$params = array_merge($request->all(), [
				'created_by' => auth()->id(),
				'updated_by' => auth()->id(),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]);
			try {
				$cloud_share_permission = CloudSharePermission::create($params);
				$message = __('cloud_share_permissions.Successfully created');
			} catch (\Illuminate\Database\QueryException $e) {
				$status = false;
				$message = $this->getErrorMessage($e, 'cloud_share_permissions');
			}
		}else{
			$status = false;
			$message = __('cloud_share_permissions.User duplicated');
		}
		
		return $this->getResponse($status, $message, $cloud_share_permission);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\CloudSharePermission  $cloud_share_permission
	 * @return \Illuminate\Http\Response
	 */
	public function show(CloudSharePermission $cloud_share_permission)
	{
		return view('cloud-share-permissions.show', compact('cloud_share_permission'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\CloudSharePermission  $cloud_share_permission
	 * @return \Illuminate\Http\Response
	 */
	public function edit(CloudSharePermission $cloud_share_permission)
	{
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		$users = User::orderBy('name', 'asc')->pluck('name', 'id');
		
		return view('cloud-share-permissions.edit', compact('cloud_share_permission','cloudDirs','users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\CloudSharePermission  $cloud_share_permission
	 * @return \Illuminate\Http\Response
	 */
	public function update(CloudSharePermissionRequest $request, CloudSharePermission $cloud_share_permission)
	{
		$status = true;
		$params = array_merge($request->all(), [
			'updated_by' => auth()->id(),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		try {
			$cloud_share_permission->update($params);
			$message = __('cloud_share_permissions.Successfully updated');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_share_permissions');
		}
		return $this->getResponse($status, $message, $cloud_share_permission);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\CloudSharePermission  $cloud_share_permission
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(CloudSharePermission $cloud_share_permission)
	{
		$status = true;
		try {
			$cloud_share_permission->delete();
			$message = __('cloud_share_permissions.Successfully deleted');
		} catch (\Illuminate\Database\QueryException $e) {
			$status = false;
			$message = $this->getErrorMessage($e, 'cloud_share_permissions');
		}
		return $this->getResponse($status, $message);
	}

	public function getQuickModalContent(CloudSharePermission $cloud_share_permission = null)
	{
		$params = request("params");
		$cloudDirs = CloudDir::orderBy('name', 'asc')->pluck('name', 'id');
		$users = User::orderBy('name', 'asc')->where('users.id', '!=', auth()->user()->id)->pluck('name', 'id');
		
		return response()->json(view('crud-maker.components.modal-quickadd', compact('params', 'cloud_share_permission','cloudDirs','users'))->render());
	}
}
