<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionFunction;

class PermissionFunctionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Sistem actions
		//Basic
		PermissionFunction::create(["name" => "index"]);
		PermissionFunction::create(["name" => "create"]);
		PermissionFunction::create(["name" => "store"]);
		PermissionFunction::create(["name" => "show"]);
		PermissionFunction::create(["name" => "update"]);
		PermissionFunction::create(["name" => "destroy"]);
		PermissionFunction::create(["name" => "edit"]);

		//autocomplete
		PermissionFunction::create(["name" => "getbyparam"]);
		PermissionFunction::create(["name" => "getquickmodalcontent"]);

		//aditionals
		PermissionFunction::create(["name" => "permissions"]);
		PermissionFunction::create(["name" => "savePermissions"]);
		PermissionFunction::create(["name" => "getAll"]);
		PermissionFunction::create(["name" => "getDetailsData"]);
		
		PermissionFunction::create(["name" => "editAJAX"]);
		PermissionFunction::create(["name" => "deleteAJAX"]);
		PermissionFunction::create(["name" => "addrow"]);

		//configuration themes
		PermissionFunction::create(["name" => "updateTheme"]);
		PermissionFunction::create(["name" => "getPartOfPreview"]);

		//Invoices
		PermissionFunction::create(["name" => "stamp"]);
		PermissionFunction::create(["name" => "invoicexml"]);
		PermissionFunction::create(["name" => "invoicepdf"]);
		PermissionFunction::create(["name" => "invoices"]);
		PermissionFunction::create(["name" => "storestamp"]);
		PermissionFunction::create(["name" => "cancel_cfdi"]);

		//Products
		PermissionFunction::create(["name" => "import"]);
		PermissionFunction::create(["name" => "export"]);
		PermissionFunction::create(["name" => "export_template"]);
		PermissionFunction::create(["name" => "export_individual"]);
		PermissionFunction::create(["name" => "changeStatus"]);
		PermissionFunction::create(["name" => "getDataTable"]);
		
		//Deliveries
		PermissionFunction::create(["name" => "addOrder"]);
		PermissionFunction::create(["name" => "goToOrder"]);
		PermissionFunction::create(["name" => "updateDeliveryStatus"]);
		PermissionFunction::create(["name" => "exportOrders"]);

		//Cloud Dirs
		PermissionFunction::create(["name" => "fileStore"]);
		PermissionFunction::create(["name" => "getCreateFolderModal"]);
		PermissionFunction::create(["name" => "getSharePermissionsModal"]);

		//Cloud Files
		PermissionFunction::create(["name" => "downloadCloudFile"]);

		//Cloud share permissions
		PermissionFunction::create(["name" => "indexParam"]);
		

		

		

	}
}
