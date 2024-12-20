<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryStatus;

class DeliveryStatusSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Request statuses
		DeliveryStatus::create(['name' => 'Inicial']);
		DeliveryStatus::create(['name' => 'Solicitud generada']);
		DeliveryStatus::create(['name' => 'Solicitud confirmada']);
		DeliveryStatus::create(['name' => 'Comprobante']);
		DeliveryStatus::create(['name' => 'Finalizado']);
	}
}
