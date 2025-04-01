<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditedUserHasDifferentPermissionsTest extends TestCase
{
    use RefreshDatabase; // reinicia la base de datos cada vez que se ejecuta el test

    public function test_edited_users_have_different_permissions()
    {
        // crea un usuario de tipo administrador
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // crea un usuario de tipo comprador para ser ascendido a administrador
        $edit_user = User::factory()->create(['role' => 'user']);

        // ejecuta la edicion
        $response = $this->put(route('admin.user.update', $edit_user->id), ['add_admin' => 'true',]);
        
        // verifica que el usuario tenga los permisos cambiados
        $edit_user->refresh();
        $this->assertEquals('admin', $edit_user->role);
    }
}
