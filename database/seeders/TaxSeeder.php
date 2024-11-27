<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Tax::create(["name" => "001", "description" => "ISR", "is_retention" => 1, "is_transfer" => 0]);
		Tax::create(["name" => "002", "description" => "IVA", "is_retention" => 1, "is_transfer" => 1]);
		Tax::create(["name" => "003", "description" => "IEPS", "is_retention" => 1, "is_transfer" => 1]);
	}
}
