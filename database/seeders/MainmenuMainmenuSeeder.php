<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainmenuMainmenu;
use App\Models\MainmenuViewname;

class MainmenuMainmenuSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$menus = [
			/** dashboard */
			[
				"name" => "dashboard",
				"icon" => '<i class="fas fa-tachometer-alt"></i>',
			],
			/** users */
			[
				"name" => "users",
				"icon" => '<i class="fas fa-user-alt"></i>',
				"children" => [
					["name" => "users", "icon" => '<i class="fas fa-user-alt"></i>'],
					["name" => "roles", "icon" => '<i class="fas fa-user-tag"></i>'],
				]
			],
			/** configuration */
			[
				"name" => "configuration",
				"icon" => '<i class="fas fa-cog"></i>',
				"children" => [
					["name" => "config_general", "icon" => '<i class="fas fa-palette"></i>'],
				]
			],
			/** Orders */
			[
				"name" => "orders",
				"icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>',
				"children" => [
					["name" => "regimes", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "cfdi_uses", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "clients", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "orders", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "order_payments", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
				]
			],
			/** Products */
			[
				"name" => "products",
				"icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>',
				"children" => [
					["name" => "departments", "icon" => '<i class="fa-solid fa-building"></i>'],
					["name" => "buying_statuses", "icon" => '<i class="fa-solid fa-traffic-light"></i>'],
					["name" => "sat_datas", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "products", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "sellers", "icon" => '<i class="fa-solid fa-truck"></i>'],
					["name" => "buyings", "icon" => '<i class="fa-solid fa-bag-shopping"></i>'],
				]
			],
			/** Inventories */
			[
				"name" => "inventories",
				"icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>',
				"children" => [
					["name" => "movement_types", "icon" => '<i class="fa-solid fa-file-invoice-dollar"></i>'],
					["name" => "other_movements", "icon" => '<i class="fa-solid fa-right-left"></i>'],
					["name" => "inventories", "icon" => '<i class="fa-solid fa-truck"></i>'],
				]
			],
			/** Deliveries */
			[
				"name" => "deliveries",
				"icon" => '<i class="fa-solid fa-truck-fast"></i>',
				"children" => [
					["name" => "warehouses", "icon" => '<i class="fa-solid fa-warehouse"></i>'],
					["name" => "destinities", "icon" => '<i class="fa-solid fa-location-dot"></i>'],
					["name" => "deliveries", "icon" => '<i class="fa-solid fa-truck-fast"></i>'],
					["name" => "confirmations", "icon" => '<i class="fa-solid fa-clipboard-check"></i>'],
				]
			],
			

			/** Cloud */
			[
				"name" => "clouds",
				"icon" => '<div class="icon" style="width: 30px;display: inline;">
								<img src="'.asset("images/nubeVoladora2.gif").'" width="50" style="width: 50px;display: inline;margin-left: -10px;margin-right: -10px;">
							</div>',
				"viewname" => 'cloud_dirs',
				// "children" => [
				// // 	["name" => "clouds", "icon" => '<div class="icon" style="width: 30px;display: inline;">
				// // 	<img src="'.asset("images/nubeVoladora2.gif").'" width="50" style="width: 50px;display: inline;margin-left: -10px;margin-right: -10px;">
				// // </div>'],
				// ["name" => "cloud_dirs", "icon" => '<i class="fa-solid fa-clipboard-check"></i>'],
				// // ["name" => "cloud_files", "icon" => '<i class="fa-solid fa-clipboard-check"></i>'],
				// // ["name" => "cloud_share_permissions", "icon" => '<i class="fa-solid fa-clipboard-check"></i>'],
				// ]
			],
		];
		$this->createMenus($menus);
	}


	public function createMenus($menus)
	{
		foreach ($menus as $key => $value) {
			$this->createMenu($value);
		}
	}

	public $menuPosition = 0;
	public function createMenu($param, $menuPosition = null, $menu_id = null)
	{
		//Set menu position as incremental value
		if($menuPosition == null)
			$this->menuPosition += 10;

		//If the param array doesn't have items then we search the viewname 
		//to link with the menu we will create
		if(!isset($param["children"])) {
			$viewname = MainmenuViewname::where("name", $param["viewname"] ?? $param["name"])->first();
		}
		//Create the menu
		$menu = MainmenuMainmenu::create([
			"name" => $param["name"], 
			"description" => $param["description"] ?? $param["name"], 
			"icon" => $param["icon"] ?? '<i class="fas fa-user"></i>',
			"menu_position" => $menuPosition ?? $this->menuPosition, 
			"mainmenu_status_id" => "1",
			"viewname_id" => !isset($param["children"]) ? $viewname->id : null,
			"mainmenu_id" => $menu_id ?? null,
		]);

		//If the menu have submenus
		$cc = 0;
		foreach ($param["children"] ?? [] as $key => $value) {
			$cc++;
			$cPos = (floatval($this->menuPosition) * 10) + ($cc*10);
			$this->createMenu($value, $cPos, $menu->id);
		}
	}
}
