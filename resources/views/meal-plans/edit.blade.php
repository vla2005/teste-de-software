<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar plano alimentar</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('dashboard') }}">NutriTreino</a>
            <nav class="nav-actions">
                <a class="btn secondary" href="{{ route('nutrition.meal-plans.index', $patient) }}">Voltar</a>
            </nav>
        </div>
    </header>

    <main class="page">
        <div class="section-header">
            <div>
                <h1>Editar plano alimentar</h1>
                <p class="lead">{{ $patient->full_name }} - {{ $patient->age }} anos - {{ $patient->goal }}</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="notice error" role="alert">
                Existem campos obrigatorios nao preenchidos.
            </div>
        @endif

        <form class="form-panel stack" method="POST" action="{{ route('nutrition.meal-plans.update', [$patient, $mealPlan]) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <label>
                    Data do plano
                    <input type="date" name="plan_date" value="{{ old('plan_date', $mealPlan->plan_date->format('Y-m-d')) }}" required>
                </label>

                <label class="full">
                    Observacoes gerais
                    <textarea name="notes">{{ old('notes', $mealPlan->notes) }}</textarea>
                </label>
            </div>

            @php
                $meals = old('meals', $mealPlan->meals->map(fn ($meal) => $meal->only(['name', 'time', 'description', 'instructions']))->toArray());
                $meals = count($meals) > 0 ? $meals : [[]];
            @endphp

            <section class="stack" aria-label="Refeicoes">
                <div class="section-header">
                    <h2>Refeicoes do plano</h2>
                    <button class="btn secondary" type="button" data-add-meal>Adicionar refeicao</button>
                </div>

                <div class="stack" data-meals-container>
                    @foreach ($meals as $index => $meal)
                        @include('meal-plans._meal-fields', ['index' => $index, 'meal' => $meal])
                    @endforeach
                </div>
            </section>

            <div class="actions">
                <button class="btn" type="submit">Atualizar plano alimentar</button>
                <a class="btn secondary" href="{{ route('student.meal-plans.show', [$patient, $mealPlan]) }}">Cancelar</a>
            </div>
        </form>

        <template data-meal-template>
            @include('meal-plans._meal-fields', ['index' => 0, 'meal' => []])
        </template>
    </main>

    <script src="{{ asset('meal-plan-form.js') }}"></script>
</body>
</html>
