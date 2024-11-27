<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Inventory extends Model
{
	use HasFactory;
	
	protected $table = 'inventories';
	protected $fillable = ['product_id', 'amount', 'mute_date', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function product()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function inventoryLogs()
	{
		return $this->hasMany('App\Models\InventoryLog');
	}

	public function getCriticals($initialDate = null, $finalDate = null)
	{
		$initialDate = $initialDate ?? new Carbon('first day of January 2024');
		// $initialDate = $initialDate ?? new Carbon(now()->subMonths(3)->startOfMonth()->toDateString());
		$finalDate = $finalDate ?? (new Carbon(now()->subMonth()->endOfMonth()->toDateString()))->endOfDay();
		$months =  $initialDate->diff($finalDate->addMonth())->format("%m");
		if($months >= 12){
			$initialDate = $initialDate ?? new Carbon(now()->subMonths(12)->startOfMonth()->toDateString());
			$months = 12;
		}
		//echo $initialDate, $finalDate;die;
		$result = $this->select(
			'inventories.*', 
			DB::raw('IF(inventories.mute_date IS NOT NULL, (IF(inventories.mute_date > \''.now()->subDays(7)->toDateString().'\', false, true)), true) as is_notifiable'),
			'products.name as product_name',
			'products.upc as upc',
			'departments.name as department',
			DB::raw('IFNULL(sub1.count_sales, 0) as count_sales'),
			DB::raw('IFNULL(sub2.sales_less_refunds, 0) as amount_sold'),
			// DB::raw('IFNULL(sub1.avg_sold, 0) as avg_sold'),
			DB::raw('ROUND(IFNULL(sub2.sales_less_refunds, 0) / '.$months.', 2) as avg_sold'),

			// DB::raw('IF((sub1.avg_sold * 3.5) > inventories.amount, 1, 0) as is_critical'),
			
			DB::raw('IFNULL(sub2.sales_less_refunds, 0) as sales_less_refunds'),
			DB::raw('IFNULL(ROUND(IFNULL(inventories.amount, 0) / IFNULL(sub2.sales_less_refunds / '.$months.', 0), 2), 0) as inventory_months'),
			DB::raw('IF( (IFNULL(inventories.amount, 0) / IFNULL(sub2.sales_less_refunds / '.$months.', 0) ) < 4, 1 , 0) as is_critical')
			)->leftJoinSub((InventoryLog::select(
				'inventory_logs.product_id as product_id', 
				DB::raw('COUNT(inventory_logs.product_id) as count_sales'), 
				DB::raw('SUM(inventory_logs.amount) as amount_sold'),
				// DB::raw('AVG(inventory_logs.amount) as avg_sold'),

			)
			->whereBetween('inventory_logs.move_date', [$initialDate, $finalDate])
			->whereIn('inventory_logs.movement_type_id', [2])
			->groupBy('inventory_logs.product_id')), 'sub1', function($j) {
			$j->on('inventories.product_id', '=', 'sub1.product_id');
		})
		
		->leftJoinSub( InventoryLog::select('product_id', 
				DB::raw('(SUM(CASE WHEN inventory_logs.movement_type_id = 2 THEN amount ELSE 0 END) - SUM(CASE WHEN inventory_logs.movement_type_id = 4 THEN amount ELSE 0 END) ) as sales_less_refunds'),
				DB::raw('SUM(CASE WHEN inventory_logs.movement_type_id = 4 THEN amount ELSE 0 END) as amount_refund ')
			)
			->whereBetween('inventory_logs.move_date', [$initialDate, $finalDate])
			->whereIn('inventory_logs.movement_type_id', [2, 4])
			->groupBy('inventory_logs.product_id'), 'sub2', function($j) {
				$j->on('inventories.product_id', '=', 'sub2.product_id');
			}
		)
		
		->leftjoin('products', 'inventories.product_id', '=', 'products.id')
		->leftjoin('departments', 'products.department_id', '=', 'departments.id');
		return $result;
	}
	
}