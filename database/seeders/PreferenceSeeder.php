<?php

namespace Database\Seeders;

use App\Models\Preference;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    public function run(): void
    {
        // Usar el método create para insertar datos manualmente
        Preference::create([
            'key' => 'ProductLimit',
            'description' => 'Limite de un producto',
            'value' => '3'
        ]);
        
        Preference::create([
            'key' => 'CartLimit',
            'description' => 'Limite de productos en el carrito',
            'value' => '10'
        ]);
    }
}

