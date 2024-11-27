<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionModule;
use App\Models\PermissionFunction;
use App\Models\PermissionPermission;

class PermissionPermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->createPermissions(["dashboard"], ["index"], false);
		/** Users */
		$this->createPermissions(["roles"], ["permissions", "savePermissions", "getAll"]);
		$this->createPermissions(["users"], ["permissions", "savePermissions", "getAll", "getDetailsData"]);

		/** Configuration */
		$this->createPermissions(["config_general"], ['getPartOfPreview']);
		
		/** Templates */
		$this->createPermissions(["templates"], ['updateTheme']);

		/** Orders */
		$this->createPermissions(["regimes", "cfdi_uses", "clients", "order_rows"]);
		$this->createPermissions(["orders"], ["stamp", "invoicexml", "invoicepdf", "storestamp", "cancel_cfdi", "invoices"]);
		$this->createPermissions(["order_payments", "order_credit_notes"], ["invoicexml", "invoicepdf", "cancel_cfdi"]);

		/** Products */
		$this->createPermissions(["departments", "buying_statuses", "products", "sellers"], ["getbyparam"]);
		$this->createPermissions(["buyings"], ["import", "export", "export_individual", "export_template", "changeStatus"]);
		$this->createPermissions(["buying_rows"], ["getDataTable", "changeStatus"]);

		/** Inventories */
		$this->createPermissions(["inventories", "inventories.logs", "movement_types"]);

		/** Movements */ 
		$this->createPermissions(["other_movements"], ["getbyparam"]);


		/** Deliveries */ 
		$this->createPermissions(["warehouses"]);
		$this->createPermissions(["destinities"]);
		$this->createPermissions(["deliveries"], ["export", "getbyparam", "addOrder", "getDataTable", "updateDeliveryStatus", "exportOrders"]);
		$this->createPermissions(["delivery_rows"], ["getDataTable", "goToOrder"]);
		$this->createPermissions(["confirmations"]);
		$this->createPermissions(["delivery_files"]);
		$this->createPermissions(["clouds"]);
		$this->createPermissions(["cloud_dirs"], ["fileStore", "getCreateFolderModal", "getSharePermissionsModal"]);
		$this->createPermissions(["cloud_files"], ["downloadCloudFile"]);
		$this->createPermissions(["cloud_share_permissions"], ['indexParam']);

		$this->createPermissions(["sat_datas"], ["getbyparam"]);

	}

	/**
	 * [createPermissions Permisos para los modulos de usuarios y roles 
	 * donde se agregan las funciones básicas y función de guardar permisos]
	 */
	public function createPermissions($moduleNames = [], $functionNames = [], $addCrudFunctions = true) {
		$defaultFunctions = ["index","store","create","show","update","destroy","edit", "getbyparam", "getquickmodalcontent"];
		$modules = PermissionModule::where('module_type_id', '2')->whereIn('name', $moduleNames)->get();
		if($addCrudFunctions) {
			$functionNames = array_merge($defaultFunctions, $functionNames);
		}
		$functions = PermissionFunction::whereIn('name', $functionNames)->get();
		
		foreach ($modules as $key => $module) {
			foreach ($functions as $key => $function) {
				PermissionPermission::create(["module_id" => $module->id, "function_id" => $function->id]);
			}
		}
	}
}
