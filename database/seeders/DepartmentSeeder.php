<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(["name" => 'Belleza',"description" => 'Artículos de belleza.', 'code' => '460']);
        Department::create(["name" => 'Mascotas',"description" => 'Artículos de mascotas.', 'code' => '080']);
    }
}
