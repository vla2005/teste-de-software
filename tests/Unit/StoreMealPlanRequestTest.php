<?php

namespace Tests\Unit;

use App\Http\Requests\StoreMealPlanRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreMealPlanRequestTest extends TestCase
{
    public function test_plano_alimentar_precisa_de_data_e_pelo_menos_uma_refeicao(): void
    {
        $request = new StoreMealPlanRequest();

        $validator = Validator::make([], $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('plan_date', $validator->errors()->toArray());
        $this->assertArrayHasKey('meals', $validator->errors()->toArray());
    }

    public function test_refeicao_precisa_de_nome_e_descricao_dos_alimentos(): void
    {
        $request = new StoreMealPlanRequest();

        $validator = Validator::make([
            'plan_date' => '2026-04-28',
            'meals' => [
                [
                    'time' => '08:00',
                    'description' => '',
                ],
            ],
        ], $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('meals.0.name', $validator->errors()->toArray());
        $this->assertArrayHasKey('meals.0.description', $validator->errors()->toArray());
    }
}
