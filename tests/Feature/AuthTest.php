<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_consegue_fazer_login_com_credenciais_validas(): void
    {
        $user = User::factory()->create([
            'email' => 'nutri@example.com',
            'password' => 'password',
            'role' => 'nutritionist',
        ]);

        $this->post(route('login.store'), [
            'email' => 'nutri@example.com',
            'password' => 'password',
        ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_usuario_nao_consegue_fazer_login_com_senha_invalida(): void
    {
        User::factory()->create([
            'email' => 'nutri@example.com',
            'password' => 'password',
        ]);

        $this->post(route('login.store'), [
            'email' => 'nutri@example.com',
            'password' => 'senha-errada',
        ])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
