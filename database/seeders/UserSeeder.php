<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			"name" => 'User',
			"paternal_surname" => 'Paternal',
			"maternal_surname" => 'Maternal',
			"email" => 'user@example.com',
			"password" => bcrypt('secret'),
			"role_id" => 1,
			"created_at" => date("Y-m-d H:i:s"),
			"updated_at" => date("Y-m-d H:i:s"),
		]);
		User::create([
			"name" => 'Roberto',
			"paternal_surname" => 'Roberto',
			"maternal_surname" => 'Roberto',
			"email" => 'roberto@zamexco.com',
			"password" => bcrypt('zamexco2023'),
			"role_id" => 2,
			"created_at" => date("Y-m-d H:i:s"),
			"updated_at" => date("Y-m-d H:i:s"),
		]);
		User::create([
			"name" => 'Dafne',
			"paternal_surname" => 'Dafne',
			"maternal_surname" => 'Dafne',
			"email" => 'dafne@zamexco.com',
			"password" => bcrypt('zamexco2023'),
			"role_id" => 2,
			"created_at" => date("Y-m-d H:i:s"),
			"updated_at" => date("Y-m-d H:i:s"),
		]);
	}
}
