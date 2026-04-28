<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'plan_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'meals' => ['required', 'array', 'min:1'],
            'meals.*.name' => ['required', 'string', 'max:255'],
            'meals.*.time' => ['nullable', 'date_format:H:i'],
            'meals.*.description' => ['required', 'string'],
            'meals.*.instructions' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'plan_date.required' => 'Informe a data do plano alimentar.',
            'meals.required' => 'Cadastre pelo menos uma refeicao no plano.',
            'meals.min' => 'Cadastre pelo menos uma refeicao no plano.',
            'meals.*.name.required' => 'Informe o nome da refeicao.',
            'meals.*.description.required' => 'Informe a descricao dos alimentos.',
        ];
    }
}
