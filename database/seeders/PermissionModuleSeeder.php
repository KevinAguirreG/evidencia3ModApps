<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionModule;

class PermissionModuleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		PermissionModule::create(["name" => "dashboard", "module_type_id" => 2]);
		
		/** Users */
		$module = PermissionModule::create(["name" => "Users", "module_type_id" => 1]);
		PermissionModule::create(["name" => "users", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "roles", "module_type_id" => 2, "module_id" => $module->id]);

		/** Configuration */
		$module = PermissionModule::create(["name" => "Configuration", "module_type_id" => 1]);
		PermissionModule::create(["name" => "config_general", "module_type_id" => 2, "module_id" => $module->id]);

		/** Templates */
		$module = PermissionModule::create(["name" => "Templates", "module_type_id" => 1]);
		PermissionModule::create(["name" => "templates", "module_type_id" => 2, "module_id" => $module->id]);

		/** orders */
		$module = PermissionModule::create(["name" => "order", "module_type_id" => 1]);
		PermissionModule::create(["name" => "regimes", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "cfdi_uses", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "clients", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "orders", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "order_rows", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "order_payments", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "order_credit_notes", "module_type_id" => 2, "module_id" => $module->id]);

		/** Movements */
		$module = PermissionModule::create(["name" => "Movements", "module_type_id" => 1]);
		PermissionModule::create(["name" => "other_movements", "module_type_id" => 2, "module_id" => $module->id]);

		/** Products */
		$module = PermissionModule::create(["name" => "Product", "module_type_id" => 1]);
		PermissionModule::create(["name" => "departments", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "products", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "sellers", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "buyings", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "buying_rows", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "buying_statuses", "module_type_id" => 2, "module_id" => $module->id]);

		/** Inventories */ 
		$module = PermissionModule::create(["name" => "Inventory", "module_type_id" => 1]);
		PermissionModule::create(["name" => "inventories", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "inventories.logs", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "movement_types", "module_type_id" => 2, "module_id" => $module->id]);

		/* Shipments */
		$module = PermissionModule::create(["name" => "Delivery", "module_type_id" => 1]);
		PermissionModule::create(["name" => "deliveries", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "warehouses", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "destinities", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "delivery_rows", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "confirmations", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "delivery_files", "module_type_id" => 2, "module_id" => $module->id]);

		/** Clouds */
		$module = PermissionModule::create(["name" => "Cloud", "module_type_id" => 1]);
		PermissionModule::create(["name" => "clouds", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "cloud_dirs", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "cloud_files", "module_type_id" => 2, "module_id" => $module->id]);
		PermissionModule::create(["name" => "cloud_share_permissions", "module_type_id" => 2, "module_id" => $module->id]);

		//Products
		PermissionModule::create(["name" => "sat_datas", "module_type_id" => 2, "module_id" => 19]);

	}
}
