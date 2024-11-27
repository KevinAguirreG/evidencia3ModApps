<?php
namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class BlankDataTable extends DataTable
{
	public $routeResource;
	public $actions = true;
	public $actionsEdit = true;
	public $actionsDelete = true;
	public $modal = true;
	public $modalCreate = true;
	public $modalEdit = true;
	public $exportExcel = false;
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query)
	{
		$datatable = datatables()->eloquent($query);
		if($this->actions) {
			$datatable->addColumn('action', function($row){
				return '<div class="btn-group" role="group">'.$this->getActions($row).'</div>';
			});
		}
		$datatable->editColumn('created_at', function ($row) {
			return date("d-m-Y H:i:s", strtotime($row->created_at));
		})->editColumn('updated_at', function ($row) {
			return date("d-m-Y H:i:s", strtotime($row->updated_at));
		})->editColumn('is_active', function ($row){
			if ($row->is_active == 1) {
				return '<span class="font-size-12 badge-soft-success badge bg-success rounded-pill text-white">'.__("Yes").'</span>';
			}elseif ($row->is_active == 0){
				return '<span class="font-size-12 badge-soft-success badge bg-danger rounded-pill text-white">'.__("No").'</span>';
			}
		})->rawColumns(["is_active", "action"]);

		//Custom filters
		if (request('custom_filters')) {
			$datatable->filter(function($query) {
				$customFilters = json_decode(request('custom_filters'), true);
				foreach ($customFilters as $key => $filter) {
					$filterType = $filter["filter_type"] ?? "=";
					$searchValue = $filterType == "LIKE" ? "%".$filter["value"]."%" : $filter["value"];
					//dd($filter["source"], $filterType, $searchValue);
					$query->where($filter["source"], $filterType, $searchValue);
				}
			}, true);
		}


		return $datatable;
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{	
		return $this->builder()
			->parameters($this->getBuilderParameters())
			->setTableId(str_replace(".", "-", $this->routeResource).'-table')
			->addTableClass('nowrap')
			->columns($this->getColumns())
			->minifiedAjax()
			->responsive('true')
			->language(asset('js/datatables/datatables_Spanish.json'))
			//->orderBy(1)
			/*->buttons(
				Button::make('excel')->text('<i class="fa fa-file-excel"></i> '.__('Excel'))
				
			)*/;
	}

	public function getBuilderParameters()
	{
		$params = [
			'pageLength' => 15,
			/*'lengthMenu'=> [
				[15,30,45, -1 ],
				[ 15, 30, 45, "Todos" ]
			],*/
			'dom' => 'fBrtip',
			'serverSide' => true,
			'processing' => true,
			'responsive' => true,
			'stateSave' => true,
			'columnDefs' => [
				['responsivePriority' => 1, 'targets' => 1] 
			],
			'buttons' => [
				['extend' => 'colvis', 'text' => 'Mostrar/Ocultar Columnas', 'className' => 'btn btn-primary']
			],
			'drawCallback' => 'function() { customizeDatatable('.($this->modal  && $this->modalCreate ? 1 : 0).') }'
		];
		if ($this->exportExcel ?? false) {
			$params['buttons'] = array_merge($params['buttons'], [
				['extend' => 'excel', 'text' => '<i class="fas fa-file-excel"></i> Exportar a excel', 'className' => 'btn btn-success'],
			]);
		}
		return $params;
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		return $this->actions ? [
			Column::computed('action', __('action'))
			->responsivePriority(2)
			->exportable(false)
			->printable(false)
			->width(200)
			->addClass('text-center'),
		] : [];
	}
	

	protected function addButton($name, $row, $label, $class = null, $isLink = true, $params = null, $confirm = false, $routeResource = null)
	{
		$result = '';
		$routeResource = $routeResource == null ? $this->routeResource : $routeResource;
		$route = Route::has($name) ? route($name, ["parent" => $row->id]) : route($routeResource.".".$name, $row->id);
		//if(auth()->user()->hasPermissions($routeResource.".".$name)) {
			if ($isLink && $confirm) {
				$isLink = false;
				$params = 'confirmRedirect(\''.__($routeResource.'.confirm_'.$name, ["param" => $row->id]).'\', \''.base64_encode($route).'\', \''.$row->id.'\')';
			}
			$result .= $isLink ? '<a '.($params ?? 'href="'.$route.'"').'>' : '';
			$result .= '
				<button type="button" class="btn btn-default font-size-18 px-0 '.($class ?? '').'"
					style="width:34px;" 
					title="'.(Lang::has($name) ? __($name) : __($routeResource.'.'.$name)).'" 
					'.(!$isLink ? 'onclick="'.$params.'" ' : '').'
				>
					'.$label.'
				</button>
			';
			$result .= $isLink ? '</a>' : '';
		//}
		return $result;
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
					"id" => $row->id
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

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return $this->routeResource.'_'.date('YmdHis');
	}
}