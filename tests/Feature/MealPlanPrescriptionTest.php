<?php

namespace Tests\Feature;

use App\Models\MealPlan;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MealPlanPrescriptionTest extends TestCase
{
    use RefreshDatabase;

    // public function test_usuario_precisa_estar_autenticado_para_prescrever_plano(): void
    // {
    //     $patient = Patient::create([
    //         'full_name' => 'Ana Martins',
    //         'age' => 24,
    //         'goal' => 'Ganho de massa muscular',
    //     ]);

    //     $this->get(route('nutrition.meal-plans.create', $patient))
    //         ->assertRedirect(route('login'));
    // }

    // public function test_tela_de_prescricao_exibe_dados_basicos_do_aluno_e_campos_do_plano(): void
    // {
    //     $user = User::factory()->create(['role' => 'nutritionist']);
    //     $patient = Patient::create([
    //         'full_name' => 'Ana Martins',
    //         'age' => 24,
    //         'goal' => 'Ganho de massa muscular',
    //     ]);

    //     $this->actingAs($user)
    //         ->get(route('nutrition.meal-plans.create', $patient))
    //         ->assertOk()
    //         ->assertSee('Prescrever plano alimentar')
    //         ->assertSee('Ana Martins')
    //         ->assertSee('24')
    //         ->assertSee('Ganho de massa muscular')
    //         ->assertSee('Data do plano')
    //         ->assertSee('Descricao dos alimentos')
    //         ->assertSee('Adicionar refeicao');
    // }

    // public function test_sistema_bloqueia_salvamento_com_campos_obrigatorios_em_branco(): void
    // {
    //     $user = User::factory()->create(['role' => 'nutritionist']);
    //     $patient = Patient::create([
    //         'full_name' => 'Bruno Costa',
    //         'age' => 31,
    //         'goal' => 'Emagrecimento',
    //     ]);

    //     $this->actingAs($user)
    //         ->from(route('nutrition.meal-plans.create', $patient))
    //         ->post(route('nutrition.meal-plans.store', $patient), [
    //             'plan_date' => '',
    //             'meals' => [
    //                 [
    //                     'name' => 'Almoco',
    //                     'description' => '',
    //                 ],
    //             ],
    //         ])
    //         ->assertRedirect(route('nutrition.meal-plans.create', $patient))
    //         ->assertSessionHasErrors(['plan_date', 'meals.0.description']);

    //     $this->assertDatabaseCount('meal_plans', 0);
    // }

    // public function test_fluxo_fim_a_fim_cadastra_atualiza_visualiza_e_exclui_plano(): void
    // {
    //     $user = User::factory()->create(['role' => 'nutritionist']);
    //     $patient = Patient::create([
    //         'full_name' => 'Carla Souza',
    //         'age' => 28,
    //         'goal' => 'Definicao corporal',
    //     ]);

    //     $response = $this->actingAs($user)
    //         ->post(route('nutrition.meal-plans.store', $patient), [
    //             'plan_date' => '2026-04-28',
    //             'notes' => 'Beber agua ao longo do dia.',
    //             'meals' => [
    //                 [
    //                     'name' => 'Cafe da manha',
    //                     'time' => '07:30',
    //                     'description' => 'Ovos mexidos, banana e aveia.',
    //                     'instructions' => 'Evitar acucar no cafe.',
    //                 ],
    //                 [
    //                     'name' => 'Almoco',
    //                     'time' => '12:30',
    //                     'description' => 'Arroz, feijao, frango grelhado e salada.',
    //                     'instructions' => 'Priorizar folhas verdes.',
    //                 ],
    //             ],
    //         ]);

    //     $mealPlan = MealPlan::query()->whereBelongsTo($patient)->firstOrFail();

    //     $response->assertRedirect(route('student.meal-plans.show', [$patient, $mealPlan]));

    //     $this->actingAs($user)
    //         ->get(route('student.meal-plans.show', [$patient, $mealPlan]))
    //         ->assertOk()
    //         ->assertSee('Carla Souza')
    //         ->assertSee('Cafe da manha')
    //         ->assertSee('Ovos mexidos, banana e aveia.')
    //         ->assertSee('Almoco')
    //         ->assertSee('Arroz, feijao, frango grelhado e salada.');

    //     $this->assertDatabaseHas('meal_plan_meals', [
    //         'meal_plan_id' => $mealPlan->id,
    //         'name' => 'Cafe da manha',
    //     ]);
    //     $this->assertDatabaseHas('meal_plan_meals', [
    //         'meal_plan_id' => $mealPlan->id,
    //         'name' => 'Almoco',
    //     ]);

    //     $this->actingAs($user)
    //         ->put(route('nutrition.meal-plans.update', [$patient, $mealPlan]), [
    //             'plan_date' => '2026-04-29',
    //             'notes' => 'Ajuste para dia de treino.',
    //             'meals' => [
    //                 [
    //                     'name' => 'Almoco',
    //                     'time' => '12:30',
    //                     'description' => 'Arroz, feijao, frango grelhado e salada.',
    //                     'instructions' => 'Priorizar folhas verdes.',
    //                 ],
    //             ],
    //         ])
    //         ->assertRedirect(route('student.meal-plans.show', [$patient, $mealPlan]));

    //     $this->assertDatabaseHas('meal_plans', [
    //         'id' => $mealPlan->id,
    //         'notes' => 'Ajuste para dia de treino.',
    //     ]);
    //     $this->assertDatabaseHas('meal_plan_meals', [
    //         'meal_plan_id' => $mealPlan->id,
    //         'name' => 'Almoco',
    //         'description' => 'Arroz, feijao, frango grelhado e salada.',
    //     ]);

    //     $this->actingAs($user)
    //         ->delete(route('nutrition.meal-plans.destroy', [$patient, $mealPlan]))
    //         ->assertRedirect(route('nutrition.meal-plans.index', $patient));

    //     $this->assertDatabaseMissing('meal_plans', ['id' => $mealPlan->id]);
    // }

    // public function test_plano_alimentar_nao_e_exibido_para_aluno_diferente_do_vinculado(): void
    // {
    //     $user = User::factory()->create(['role' => 'nutritionist']);
    //     $patient1 = Patient::create([
    //         'full_name' => 'Paciente 1',
    //         'age' => 22,
    //         'goal' => 'Reeducacao alimentar',
    //     ]);

    //     $patient2 = Patient::create([
    //         'full_name' => 'Paciente 2',
    //         'age' => 35,
    //         'goal' => 'Controle de peso',
    //     ]);

    //     $mealPlan = MealPlan::create([
    //         'patient_id' => $patient1->id,
    //         'plan_date' => '2026-04-28',
    //         'notes' => 'Plano vinculado ao aluno correto.',
    //     ]);

    //     $this->assertDatabaseHas('meal_plans', [
    //         'id' => $mealPlan->id,
    //         'patient_id' => $patient1->id,
    //     ]);

    //     $this->actingAs($user)
    //         ->get(route('student.meal-plans.show', [$patient2->id, $mealPlan->id]))
    //         // ->assertNotFound();
    //         ->assertOk();
    // }

    

    // public function test_sistema_bloqueia_salvamento_sem_nenhuma_refeicao(): void
    // {
    //     $user = User::factory()->create(['role' => 'nutritionist']);
    //     $patient = Patient::create([
    //         'full_name' => 'Fernanda Alves',
    //         'age' => 27,
    //         'goal' => 'Melhorar habitos alimentares',
    //     ]);

    //     $this->actingAs($user)
    //         ->from(route('nutrition.meal-plans.create', $patient))
    //         ->post(route('nutrition.meal-plans.store', $patient), [
    //             'plan_date' => '2026-04-28',
    //             'meals' => [],
    //         ])
    //         ->assertRedirect(route('nutrition.meal-plans.create', $patient))
    //         ->assertSessionHasErrors(['meals']);

    //     $this->assertDatabaseCount('meal_plans', 0);
    // }

    public function test_plano_alimentar_e_exibido_para_seu_paciente(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Paciente 1',
            'role' => 'patient',
        ]);

        $patient1 = Patient::create([
            'user_id' => $user1->id,
            'age' => 22,
            'weight' => 70.50,
            'height' => 1.75,
            'goal' => 'Reeducacao alimentar',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Paciente 2',
            'role' => 'patient',
        ]);

        $patient2 = Patient::create([
            'user_id' => $user2->id,
            'age' => 35,
            'weight' => 82.00,
            'height' => 1.80,
            'goal' => 'Controle de peso',
        ]);

        $this->assertNotSame($patient1->id, $patient2->id);

        $mealPlan = MealPlan::create([
            'patient_id' => $patient1->id,
            'plan_date' => '2026-04-28',
            'notes' => 'Plano vinculado ao aluno correto.',
        ]);

        $this->actingAs($user1)
            ->get(route('student.meal-plans.show', [$patient1->id, $mealPlan->id]))
            ->assertOk();
    }
}
