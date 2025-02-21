<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Order::factory()->create([
            'user_id' => 1,
            'total_price' => 5.15,
            'status' => 'ordered',
            'order_date' => now(),
            'confirmation_date' => null
        ]);

        Order::factory()->create([
            'user_id' => 1,
            'total_price' => 12.25,
            'status' => 'ordered',
            'order_date' => now(),
            'confirmation_date' => null
        ]);

        Order::factory()->create([
            'user_id' => 1,
            'total_price' => 3.45,
            'status' => 'confirmed',
            'order_date' => now(),
            'confirmation_date' => now()
        ]);
    }
}
