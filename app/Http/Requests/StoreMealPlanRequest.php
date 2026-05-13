<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMealPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        if ($this->is('api/*')) {
            throw new HttpResponseException(response()->json([
                'message' => 'Os dados informados sao invalidos.',
                'errors' => $validator->errors(),
            ], 422));
        }

        parent::failedValidation($validator);
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
