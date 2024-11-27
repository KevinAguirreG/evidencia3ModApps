<?php

namespace Database\Seeders;

use App\Models\BuyingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuyingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuyingStatus::create(["name" => "Draft"]);
        BuyingStatus::create(["name" => "Sent"]);
    }
}
