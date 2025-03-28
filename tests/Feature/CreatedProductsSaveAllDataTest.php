<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatedProductsSaveAllDataTest extends TestCase
{
    use RefreshDatabase; // reinicia la base de datos cada vez que se ejecuta el test

    public function test_created_products_save_all_data()
    {
        // crea un usuario de tipo administrador para poder acceder a crear un producto
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // crea una categoria para poder crear el producto y asociarsela
        $category = Category::factory()->create();
        $this->assertDatabaseHas('categories', ['id' => $category->id]);

        // datos del producto a crear
        $product_data = [
            'category_id' => $category->id,
            'code' => '123456',
            'name' => 'ProductoDelTest',
            'price' => 12.34,
        ];

        // envia el producto a ser creado
        $response = $this->post(route('admin.product.store'), $product_data);

        // comprueba los datos del producto creado
        $this->assertDatabaseHas('products', [
            'category_id' => $category->id,
            'code' => '123456',
            'name' => 'ProductoDelTest',
            'price' => 12.34,
            'description' => null,
            'featured' => false,
            'active' => true
        ]);
    }
}

