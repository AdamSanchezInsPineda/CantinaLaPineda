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
            'total_price' => 149.97,
            'status' => 'ordered',
            'order_date' => '2025-01-15',
            'confirmation_date' => null
        ]);

        Order::factory()->create([
            'user_id' => 1,
            'total_price' => 89.98,
            'status' => 'ordered',
            'order_date' => '2025-02-10',
            'confirmation_date' => null
        ]);
    }
}
