<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call([
			RoleSeeder::class,
			UserSeeder::class,

			//Mod permissions
			PermissionModuleTypeSeeder::class,
			PermissionModuleSeeder::class,
			PermissionFunctionSeeder::class,
			PermissionPermissionSeeder::class,
			PermissionPermissionRoleSeeder::class,

			//Mod mainmenu
			MainmenuMainmenuStatusSeeder::class,
			MainmenuViewnameSeeder::class,
			MainmenuMainmenuSeeder::class,

			//Templates
			TemplateSeeder::class,

			//Fonts
			FontSeeder::class,

			//Cfdi catalogs
			CfdiUseSeeder::class,
			RegimeSeeder::class,
			TaxSeeder::class,
			PaymentTypeSeeder::class,
			PaymentMethodSeeder::class,


			ConfigSeeder::class,
			ClientSeeder::class,
			DepartmentSeeder::class,
			SatDataSeeder::class,
			ProductSeeder::class,
			SellerSeeder::class,

			//Movements
			MovementTypeSeeder::class,
			BuyingStatusSeeder::class,
			

			// Delivery
			BranchSeeder::class,
			DeliveryStatusSeeder::class,
			WarehouseSeeder::class,
			DestinitySeeder::class,
		]);
	}
}
