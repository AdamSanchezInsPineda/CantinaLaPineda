<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Product::factory()->create([
            'category_id' => 1,
            'name' => 'Pan con queso maximo',
            'featured' => true
        ]);

        Product::factory()->create([
            'category_id' => 2,
            'name' => 'fuzztea',
            'featured' => true
        ]);
    }
}
