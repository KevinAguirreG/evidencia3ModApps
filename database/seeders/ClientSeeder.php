<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Client::create([
			"name" => "HEB",
			"folio" => "962",
			"zipcode" => "64060",
			"company_name" => "SUPERMERCADOS INTERNACIONALES H E B",
			"rfc" => "SIH9511279T7",
			"regime_id" => 1,
			"tax_address" => "HIDALGO, 2405 , OBISPADO 64060, Monterrey, Nuevo León",
			"cfdi_use_id" => 3
		]);
		
		Client::create([
			"name" => "WALMART",
			"folio" => "962",
			"zipcode" => "02770",
			"company_name" => "NUEVA WAL MART DE MEXICO",
			"rfc" => "NWM9709244W4",
			"regime_id" => 1,
			"tax_address" => "NEXTENGO, 78 , SANTA CRUZ ACAYUCAN 02770, CIUDAD DE MEXICO",
			"cfdi_use_id" => 3
		]);
	}
}
 