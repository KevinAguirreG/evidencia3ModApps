<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SatData;

class SatDataSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		SatData::create(["description" => "Cepillos o peinillas para el cabello", "number" => "53131604", "code" => "KGM"]);
		SatData::create(["description" => "Productos para el aseo y cuidado de mascotas", "number" => "10111302", "code" => "KGM"]);
		SatData::create(["description" => "Juguetes para mascotas", "number" => "10111301", "code" => "KGM"]);

	}
}
