<?php

namespace Tests\Feature;

use App\Models\MealPlan;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiMealPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_cadastra_e_lista_planos_alimentares(): void
    {
        $patient = Patient::create([
            'full_name' => 'Carla Souza',
            'age' => 28,
            'goal' => 'Definicao corporal',
        ]);

        $this->postJson(route('api.meal-plans.store', $patient), [
            'plan_date' => '2026-04-28',
            'notes' => 'Beber agua.',
            'meals' => [
                [
                    'name' => 'Cafe da manha',
                    'time' => '07:30',
                    'description' => 'Ovos mexidos e banana.',
                    'instructions' => 'Evitar acucar.',
                ],
            ],
        ])
            ->assertCreated()
            ->assertJsonPath('data.patient_id', $patient->id)
            ->assertJsonPath('data.meals.0.name', 'Cafe da manha');

        $this->getJson(route('api.meal-plans.index', $patient))
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_api_valida_campos_obrigatorios(): void
    {
        $patient = Patient::create([
            'full_name' => 'Bruno Costa',
            'age' => 31,
            'goal' => 'Emagrecimento',
        ]);

        $this->postJson(route('api.meal-plans.store', $patient), [
            'plan_date' => '',
            'meals' => [],
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['plan_date', 'meals']);
    }

    public function test_api_retorna_erros_de_validacao_em_json_mesmo_sem_header_accept(): void
    {
        $patient = Patient::create([
            'full_name' => 'Bruno Costa',
            'age' => 31,
            'goal' => 'Emagrecimento',
        ]);

        $this->post(route('api.meal-plans.store', $patient), [
            'plan_date' => '',
            'meals' => [],
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['plan_date', 'meals']);
    }

    public function test_api_atualiza_e_exclui_plano_alimentar(): void
    {
        $patient = Patient::create([
            'full_name' => 'Diego Lima',
            'age' => 22,
            'goal' => 'Reeducacao alimentar',
        ]);

        $mealPlan = $patient->mealPlans()->create([
            'plan_date' => '2026-04-28',
            'notes' => 'Plano inicial.',
        ]);

        $mealPlan->meals()->create([
            'name' => 'Jantar',
            'time' => '19:30',
            'description' => 'Sopa de legumes.',
        ]);

        $this->putJson(route('api.meal-plans.update', [$patient, $mealPlan]), [
            'plan_date' => '2026-04-29',
            'notes' => 'Plano atualizado.',
            'meals' => [
                [
                    'name' => 'Ceia',
                    'time' => '21:00',
                    'description' => 'Iogurte natural com frutas.',
                ],
            ],
        ])
            ->assertOk()
            ->assertJsonPath('data.notes', 'Plano atualizado.')
            ->assertJsonPath('data.meals.0.name', 'Ceia');

        $this->deleteJson(route('api.meal-plans.destroy', [$patient, MealPlan::findOrFail($mealPlan->id)]))
            ->assertNoContent();

        $this->assertDatabaseMissing('meal_plans', ['id' => $mealPlan->id]);
    }
}
