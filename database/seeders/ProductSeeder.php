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
            'name' => 'Bocadillo de frankfurt',
            'featured' => true
        ]);

        Product::factory()->create([
            'category_id' => 2,
            'name' => 'fuzztea',
            'featured' => true
        ]);

        Product::factory()->create([
            'category_id' => 1,
            'name' => 'Bocadillo de tortilla',
            'featured' => true
        ]);

        Product::factory()->create([
            'category_id' => 1,
            'name' => 'Bocadillo de bacon',
            'featured' => true
        ]);

        Product::factory()->create([
            'category_id' => 2,
            'name' => 'coca-cola',
            'featured' => true
        ]);

        Product::factory()->create([
            'category_id' => 2,
            'name' => 'fanta de naranja',
            'featured' => true
        ]);
    }
}
