<?php

namespace App\DataTables;

use App\Models\CloudFile;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CloudFileDataTable extends BlankDataTable
{
	public function __construct()
	{
		$this->routeResource = 'cloud_files';
	}
	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Selling $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(CloudFile $model)
	{
		return $model->select(
			'cloud_files.*',
			'cloud_dirs.name as cloud_dir_id'
		)
		->leftjoin('cloud_dirs', 'cloud_files.cloud_dir_id', '=', 'cloud_dirs.id')
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
			['data' => 'id', 'visible' => false, 'title' => __('cloud_files.id')],
			['data' => 'cloud_dir_id', 'title' => __('cloud_files.cloud_dir_id'), 'name' => 'cloud_dirs.name'],
			['data' => 'description', 'title' => __('cloud_files.description')],
			['data' => 'file_path', 'title' => __('cloud_files.file_path')],
			['data' => 'notes', 'title' => __('cloud_files.notes')],
			['data' => 'is_active', 'visible' => false, 'title' => __('cloud_files.is_active')],
			['data' => 'created_by', 'visible' => false, 'title' => __('cloud_files.created_by')],
			['data' => 'updated_by', 'visible' => false, 'title' => __('cloud_files.updated_by')],
			['data' => 'created_at', 'visible' => false, 'title' => __('cloud_files.created_at')],
			['data' => 'updated_at', 'visible' => false, 'title' => __('cloud_files.updated_at')],
		];
		return array_merge($columns, $pColumns);
	}
}
