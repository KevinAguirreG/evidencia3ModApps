<?php

namespace App\DataTables;

use App\Models\CloudSharePermission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CloudSharePermissionDataTable extends BlankDataTable
{

	public $cloud_dir_id;

	public function __construct($cloud_dir_id = null)
	{
		$this->cloud_dir_id = $cloud_dir_id;
		$this->routeResource = 'cloud_share_permissions';
	}
	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Selling $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(CloudSharePermission $model)
	{
		$query = $model->select(
			'cloud_share_permissions.*',
			'cloud_dirs.id as cloud_dir_id',
			'cloud_dirs.name as cloud_dir_name',
			'users.name as user_id'
		)
		->leftjoin('cloud_dirs', 'cloud_share_permissions.cloud_dir_id', '=', 'cloud_dirs.id')
		->leftjoin('users', 'cloud_share_permissions.user_id', '=', 'users.id');
		if($this->cloud_dir_id ?? false){
			$query = $query->where('cloud_share_permissions.cloud_dir_id', $this->cloud_dir_id);
		}

		return $query->newQuery();
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		$pColumns = parent::getColumns();
		$columns = [
			['data' => 'id', 'visible' => false, 'title' => __('cloud_share_permissions.id')],
			// ['data' => 'cloud_dir_id', 'title' => __('cloud_share_permissions.cloud_dir_id'), 'name' => 'cloud_dirs.id'],
			['data' => 'user_id', 'title' => __('cloud_share_permissions.user_id'), 'name' => 'users.name'],
			['data' => 'delete_permission', 'title' => __('cloud_share_permissions.delete_permission')],
			['data' => 'upload_permission', 'title' => __('cloud_share_permissions.upload_permission')],
			// ['data' => 'notes', 'title' => __('cloud_share_permissions.notes')],
			['data' => 'is_active', 'visible' => false, 'title' => __('cloud_share_permissions.is_active')],
			['data' => 'created_by', 'visible' => false, 'title' => __('cloud_share_permissions.created_by')],
			['data' => 'updated_by', 'visible' => false, 'title' => __('cloud_share_permissions.updated_by')],
			['data' => 'created_at', 'visible' => false, 'title' => __('cloud_share_permissions.created_at')],
			['data' => 'updated_at', 'visible' => false, 'title' => __('cloud_share_permissions.updated_at')],
		];
		return array_merge($columns, $pColumns);
	}
	public function getActions($row)
	{
		$result = '';
		if($this->actionsEdit && auth()->user()->hasPermissions($this->routeResource.".edit")) {
			if ($this->modal && $this->modalEdit) {
				$params = base64_encode(json_encode([
					"entity_source" => $this->routeResource,
					"entity" => $this->routeResource,
					"saveAditionals" => 'reloadDatatable',
					"id" => $row->id,
					"parent" => $row->cloud_dir_id
				]));
				
				$result .= $this->addButton('edit', $row, '<i class="fa-solid fa-pencil"></i>', '', false, 'showQuickAddModal(\''.$params.'\')');
			} else {
				$result .= $this->addButton('edit', $row, '<i class="fa-solid fa-pencil"></i>');
			}
		}
		if($this->actionsDelete && auth()->user()->hasPermissions($this->routeResource.".destroy")) {
			$result .= $this->addButton('destroy', $row, '<i class="fa-solid fa-trash"></i>', '', false, 'showDeleteModal(\''.$this->routeResource.'\', '.$row->id.')');
		}

		return $result;
	}
	public function dataTable($query)
	{
		$datatable = parent::dataTable($query);
		$datatable->editColumn('upload_permission', function ($row) {
			$r = $row->upload_permission == true ? '<i class="fa-solid fa-check fa-xl text-success"></i>' : '<i class="fa-solid fa-xmark fa-xl text-danger"></i>';
			return $r;
		})->editColumn('delete_permission', function ($row) {
			$r = $row->delete_permission == true ? '<i class="fa-solid fa-check fa-xl text-success"></i>' : '<i class="fa-solid fa-xmark fa-xl text-danger"></i>';
			return $r;
		})->rawColumns(['upload_permission', 'delete_permission', 'action']);


		return $datatable;
	}
}
