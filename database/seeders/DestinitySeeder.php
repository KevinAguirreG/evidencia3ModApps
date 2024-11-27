<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destinity;

class DestinitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Destinity::create(['name' => 'Porteo', 'description' => 'Porteo', 'orders_quantity' => 1000, 'warehouse_id' => 3]);
		Destinity::create(['name' => 'La luz', 'description' => 'La luz', 'orders_quantity' => 10, 'warehouse_id' => 1]);
		Destinity::create(['name' => 'Chalco', 'description' => 'Chalco', 'orders_quantity' => 10, 'warehouse_id' => 1]);
	}
}
