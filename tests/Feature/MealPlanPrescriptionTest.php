<?php

namespace Tests\Feature;

use App\Models\MealPlan;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MealPlanPrescriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_tela_de_prescricao_exibe_dados_basicos_do_aluno_e_campos_do_plano(): void
    {
        $patient = Patient::create([
            'full_name' => 'Ana Martins',
            'age' => 24,
            'goal' => 'Ganho de massa muscular',
        ]);

        $this->get(route('nutrition.meal-plans.create', $patient))
            ->assertOk()
            ->assertSee('Prescrever plano alimentar')
            ->assertSee('Ana Martins')
            ->assertSee('24')
            ->assertSee('Ganho de massa muscular')
            ->assertSee('Data do plano')
            ->assertSee('Descricao dos alimentos');
    }

    public function test_sistema_bloqueia_salvamento_com_campos_obrigatorios_em_branco(): void
    {
        $patient = Patient::create([
            'full_name' => 'Bruno Costa',
            'age' => 31,
            'goal' => 'Emagrecimento',
        ]);

        $this->from(route('nutrition.meal-plans.create', $patient))
            ->post(route('nutrition.meal-plans.store', $patient), [
                'plan_date' => '',
                'meals' => [
                    [
                        'name' => 'Almoco',
                        'description' => '',
                    ],
                ],
            ])
            ->assertRedirect(route('nutrition.meal-plans.create', $patient))
            ->assertSessionHasErrors(['plan_date', 'meals.0.description']);

        $this->assertDatabaseCount('meal_plans', 0);
    }

    public function test_fluxo_fim_a_fim_cadastra_plano_e_disponibiliza_na_area_do_aluno(): void
    {
        $patient = Patient::create([
            'full_name' => 'Carla Souza',
            'age' => 28,
            'goal' => 'Definicao corporal',
        ]);

        $response = $this->post(route('nutrition.meal-plans.store', $patient), [
            'plan_date' => '2026-04-28',
            'notes' => 'Beber agua ao longo do dia.',
            'meals' => [
                [
                    'name' => 'Cafe da manha',
                    'time' => '07:30',
                    'description' => 'Ovos mexidos, banana e aveia.',
                    'instructions' => 'Evitar acucar no cafe.',
                ],
                [
                    'name' => 'Almoco',
                    'time' => '12:30',
                    'description' => 'Arroz, feijao, frango grelhado e salada.',
                    'instructions' => 'Priorizar folhas verdes.',
                ],
            ],
        ]);

        $mealPlan = MealPlan::query()->whereBelongsTo($patient)->firstOrFail();

        $response->assertRedirect(route('student.meal-plans.show', [$patient, $mealPlan]));
        $this->assertDatabaseHas('meal_plan_meals', [
            'meal_plan_id' => $mealPlan->id,
            'name' => 'Cafe da manha',
            'description' => 'Ovos mexidos, banana e aveia.',
        ]);

        $this->get(route('student.meal-plans.show', [$patient, $mealPlan]))
            ->assertOk()
            ->assertSee('Carla Souza')
            ->assertSee('Definicao corporal')
            ->assertSee('Cafe da manha')
            ->assertSee('Ovos mexidos, banana e aveia.')
            ->assertSee('Almoco')
            ->assertSee('Arroz, feijao, frango grelhado e salada.');
    }
}
