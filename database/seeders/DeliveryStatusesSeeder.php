<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryStatuses;

class DeliveryStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Request statuses
        DeliveryStatuses::create(['name' => 'Solicitud generada', 'is_active' => 1,]);
        DeliveryStatuses::create(['name' => 'Solicitud enviada', 'is_active' => 1,]);
        DeliveryStatuses::create(['name' => 'Solicitud pendiente de confirmación', 'is_active' => 1,]);
        DeliveryStatuses::create(['name' => 'Solicitud confirmada', 'is_active' => 1,]);

        // Shipment statuses
        DeliveryStatuses::create(['name' => 'Mercancía enviada', 'is_active' => 1,]);
        DeliveryStatuses::create(['name' => 'Mercancía en camino', 'is_active' => 1,]);
        DeliveryStatuses::create(['name' => 'Mercancía entregada', 'is_active' => 1,]);
        
    }
}
