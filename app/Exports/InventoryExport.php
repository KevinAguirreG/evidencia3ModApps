<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class InventoryExport implements FromCollection, WithHeadings, WithMapping, WithStrictNullComparison, ShouldAutoSize
{
	use Exportable;
	/*private $query;
	public function __construct($query)
	{
		$this->query = $query;
	}*/

	public function collection()
	{
		return (new Inventory)->getCriticals()->get();
	}
	
	public function map($row): array
	{
		$result = [];
		if ($row->is_notifiable) {
			$result = [
				$row->id,
				$row->product_name,
				$row->upc,
				$row->department,
				$row->amount,
				// $row->count_sales,
				$row->amount_sold,
				$row->avg_sold,
				$row->inventory_months,
				$row->is_critical == 1 ? __('inventories.is_critical') : '',
			];
		}
		return $result;
	}

	public function headings(): array
	{
		return [
			__('inventories.id'),
			__('inventories.product_name'),
			__('inventories.upc'),
			__('inventories.department'),
			__('inventories.amount'),
			// __('inventories.export_count_sales'),
			__('inventories.export_amount_sold'),
			__('inventories.export_avg_sold'),
			__('inventories.inventory_months'),
			__('inventories.is_critical'),
		];
	}
}