<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OtherDestroyMethodsDeleteRegistries extends TestCase
{
    use RefreshDatabase; // reinicia la base de datos cada vez que se ejecuta el test

    public function test_other_destroy_methods_work()
    {
        // crea un usuario de tipo administrador
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
    
        // crea una categoria para eliminar
        $category = Category::factory()->create(['name' => 'categoria_test']);
    
        // ejecuta la funcion de eliminar
        $response = $this->delete(route('admin.category.destroy', $category->id));
    
        // verifica que la categoria haya sido eliminada de la base de datos
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }    
}