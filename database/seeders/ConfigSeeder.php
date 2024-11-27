<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Config::create([
			"company_name" => "ZAMEXCO INTERNATIONAL",
			"rfc" => "ZIN1612074A8",
			"zipcode" => "25790",
			"regime_id" => 1,
			"address" => "Josefa O de Dominguez, #1503 , Monclova, Eva Samano de Lopez Mateos
			CP. 25790, , Coahuila",
		]);
	}
}
