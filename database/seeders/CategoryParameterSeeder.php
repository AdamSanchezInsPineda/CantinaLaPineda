<?php

namespace Database\Seeders;

use App\Models\CategoryParameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryParameter::factory()->create([
            'description' => "Añadir queso",
            'category_id' => 1
        ]);
    }
}
