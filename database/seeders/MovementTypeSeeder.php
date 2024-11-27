<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MovementType;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovementType::create(["name" => "Compras"]);
        MovementType::create(["name" => "Facturas"]);
        MovementType::create(["name" => "Otros movimientos"]);
        MovementType::create(["name" => "Alta por cancelación de facturas"]);

    }
}
