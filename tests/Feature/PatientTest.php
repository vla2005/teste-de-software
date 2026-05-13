<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_cadastra_paciente(): void
    {
        $user = User::factory()->create(['role' => 'nutritionist']);

        $this->actingAs($user)
            ->post(route('patients.store'), [
                'full_name' => 'Mariana Lopes',
                'age' => 26,
                'goal' => 'Ganho de massa muscular',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('patients', [
            'full_name' => 'Mariana Lopes',
            'age' => 26,
            'goal' => 'Ganho de massa muscular',
        ]);
    }

    public function test_sistema_valida_campos_obrigatorios_do_paciente(): void
    {
        $user = User::factory()->create(['role' => 'nutritionist']);

        $this->actingAs($user)
            ->from(route('patients.create'))
            ->post(route('patients.store'), [
                'full_name' => '',
                'age' => '',
                'goal' => '',
            ])
            ->assertRedirect(route('patients.create'))
            ->assertSessionHasErrors(['full_name', 'age', 'goal']);

        $this->assertDatabaseCount('patients', 0);
    }

    public function test_usuario_autenticado_atualiza_e_exclui_paciente(): void
    {
        $user = User::factory()->create(['role' => 'nutritionist']);
        $patient = Patient::create([
            'full_name' => 'Carlos Mendes',
            'age' => 34,
            'goal' => 'Controle de peso',
        ]);

        $this->actingAs($user)
            ->put(route('patients.update', $patient), [
                'full_name' => 'Carlos Mendes Silva',
                'age' => 35,
                'goal' => 'Reeducacao alimentar',
            ])
            ->assertRedirect(route('nutrition.meal-plans.index', $patient));

        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'full_name' => 'Carlos Mendes Silva',
            'age' => 35,
            'goal' => 'Reeducacao alimentar',
        ]);

        $this->actingAs($user)
            ->delete(route('patients.destroy', $patient))
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
    }
}
