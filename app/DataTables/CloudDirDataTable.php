<?php

namespace App\DataTables;

use App\Models\CloudDir;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CloudDirDataTable extends BlankDataTable
{
	public function __construct()
	{
		$this->routeResource = 'cloud_dirs';
	}
	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Selling $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(CloudDir $model)
	{
		return $model->select(
			'cloud_dirs.*',
			// 'cloud_dirs.name as cloud_dir_id',
			'users.name as user_id'
		)
		// ->leftjoin('cloud_dirs', 'cloud_dirs.cloud_dir_id', '=', 'cloud_dirs.id')
		->leftjoin('users', 'cloud_dirs.user_id', '=', 'users.id')
		->newQuery();
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
			['data' => 'id', 'visible' => false, 'title' => __('cloud_dirs.id')],
			// ['data' => 'cloud_dir_id', 'title' => __('cloud_dirs.cloud_dir_id'), 'name' => 'cloud_dirs.name'],
			['data' => 'user_id', 'title' => __('cloud_dirs.user_id'), 'name' => 'users.name'],
			['data' => 'name', 'title' => __('cloud_dirs.name')],
			['data' => 'url', 'title' => __('cloud_dirs.url')],
			['data' => 'notes', 'title' => __('cloud_dirs.notes')],
			['data' => 'is_active', 'visible' => false, 'title' => __('cloud_dirs.is_active')],
			['data' => 'created_by', 'visible' => false, 'title' => __('cloud_dirs.created_by')],
			['data' => 'updated_by', 'visible' => false, 'title' => __('cloud_dirs.updated_by')],
			['data' => 'created_at', 'visible' => false, 'title' => __('cloud_dirs.created_at')],
			['data' => 'updated_at', 'visible' => false, 'title' => __('cloud_dirs.updated_at')],
		];
		return array_merge($columns, $pColumns);
	}
}
