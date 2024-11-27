<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionModule;
use App\Models\PermissionPermission;
use App\Models\PermissionPermissionRole;

class PermissionPermissionRoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//All permissions for role 1 = Admin
		$permissions = PermissionPermission::all();
		foreach ($permissions as $key => $permission) {
			PermissionPermissionRole::create(["permission_id" => $permission->id, "role_id" => 1]);
		}

		//All permissions for role 2
		$role_id = 2;
		$this->assignPermission([
			"regimes",
			"cfdi_uses",
			"products",
			"clients",
			"orders",
			"order_rows",
			"buyings",
			"buying_rows",
			"buying_statuses",
			"buying_statuses",
			"movement_types",
			"inventories",
			"inventory_logs",
			"deliveries", 
			"warehouses",
			"destinities",
			"delivery_rows",
			"confirmation",
			"clouds",
			"cloud_dirs",
			"cloud_files",
			"cloud_share_permissions",
		], null, $role_id); //Permissions for all the dashboards
	}

	/**
	 * [assignPermission] Find on permissions table by module and function names and assing them to the designed role
	 *
	 * @param [type] $moduleNames
	 * @param [type] $functionNames
	 * @param [type] $role_id
	 * @return void
	 */
	public function assignPermission($moduleNames, $functionNames = null, $role_id)
	{
		$modules = PermissionModule::whereIn("name", $moduleNames)->where("module_type_id", 2)->get('id');
		
		//If functions are sent filter only that funcions
		$permissions = PermissionPermission::whereIn("module_id", $modules);
		if($functionNames != null) {
			$functions = PermissionFunction::whereIn("name", $functionNames)->get('id');
			$permissions = $permissions->whereIn("function_id", $functions);
		}
		$permissions = $permissions->get();

		foreach ($permissions as $key => $permission) {
			PermissionPermissionRole::create(["permission_id" => $permission->id, "role_id" => $role_id]);
		}
	}
}
