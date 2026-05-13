<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plano alimentar do aluno</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('dashboard') }}">NutriTreino</a>
            <nav class="nav-actions">
                <a class="btn secondary" href="{{ route('nutrition.meal-plans.index', $patient) }}">Planos</a>
            </nav>
        </div>
    </header>

    <main class="page">
        <div class="section-header">
            <div>
                <h1>Plano alimentar</h1>
                <p class="lead">{{ $patient->full_name }} - {{ $patient->age }} anos - {{ $patient->goal }}</p>
            </div>
            <a class="btn secondary" href="{{ route('nutrition.meal-plans.edit', [$patient, $mealPlan]) }}">Editar</a>
        </div>

        @if (session('status'))
            <p class="notice success" role="status">{{ session('status') }}</p>
        @endif

        <section class="form-panel">
            <h2>Resumo</h2>
            <p>Data do plano: {{ $mealPlan->plan_date->format('d/m/Y') }}</p>
            @if ($mealPlan->notes)
                <p>Observacoes gerais: {{ $mealPlan->notes }}</p>
            @endif
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Refeicoes</h2>
                <span class="meta">{{ $mealPlan->meals->count() }} item(ns)</span>
            </div>
            <div class="meal-list">
        @foreach ($mealPlan->meals as $meal)
            <article class="card meal-item">
                <h2>{{ $meal->name }}</h2>
                @if ($meal->time)
                    <p class="meta">Horario: {{ substr($meal->time, 0, 5) }}</p>
                @endif
                <p>{{ $meal->description }}</p>
                @if ($meal->instructions)
                    <p>{{ $meal->instructions }}</p>
                @endif
            </article>
        @endforeach
            </div>
        </section>
    </main>
</body>
</html>
