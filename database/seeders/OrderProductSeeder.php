<?php

namespace Database\Seeders;

use App\Models\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        OrderProduct::factory()->create([
            'product_id' => 1,
            'order_id' => 1,
            'quantity' => 3
        ]);

        OrderProduct::factory()->create([
            'product_id' => 2,
            'order_id' => 1,
            'quantity' => 1
        ]);

        OrderProduct::factory()->create([
            'product_id' => 2,
            'order_id' => 2,
            'quantity' => 2
        ]);

        OrderProduct::factory()->create([
            'product_id' => 2,
            'order_id' => 3,
            'quantity' => 1
        ]);
    }
}
