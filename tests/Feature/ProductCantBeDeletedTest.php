<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsCantBeDeletedTest extends TestCase
{
    use RefreshDatabase; // reinicia la base de datos cada vez que se ejecuta el test

    public function test_products_arent_deleted()
    {
        // crea un usuario de tipo administrador para poder acceder a crear un producto
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // crea un producto de prueba en la base de datos
        $product = Product::factory()->create(['active' => true]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'active' => true]);

        // ejecuta el destroy
        $response = $this->post(route('admin.product.destroy', $product->id));

        // verifica que el producto aún existe en la base de datos
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }
}
