<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Warehouse::create(['name' => '7494 NV1']);
		Warehouse::create(['name' => '7464 NV2']);
		Warehouse::create(['name' => '7489 XTO']);
		Warehouse::create(['name' => '7492 XTO']);
		Warehouse::create(['name' => '7482 STB']);
		Warehouse::create(['name' => '7457 BAE']);
		Warehouse::create(['name' => '7492 MGPK']);
	}
}
