<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planos alimentares</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('dashboard') }}">NutriTreino</a>
            <nav class="nav-actions">
                <a class="btn secondary" href="{{ route('dashboard') }}">Painel</a>
            </nav>
        </div>
    </header>

    <main class="page">
        <div class="section-header">
            <div>
                <h1>Planos alimentares</h1>
                <p class="lead">{{ $patient->full_name }} - {{ $patient->age }} anos - {{ $patient->goal }}</p>
            </div>
            <a class="btn" href="{{ route('nutrition.meal-plans.create', $patient) }}">Novo plano</a>
        </div>

        @if (session('status'))
            <p class="notice success" role="status">{{ session('status') }}</p>
        @endif

        <section class="grid section">
        @forelse ($mealPlans as $mealPlan)
            <article class="card">
                <h2>Plano de {{ $mealPlan->plan_date->format('d/m/Y') }}</h2>
                <p class="meta">{{ $mealPlan->meals->count() }} refeicao(oes) cadastrada(s)</p>
                @if ($mealPlan->notes)
                    <p>{{ $mealPlan->notes }}</p>
                @endif

                <div class="actions">
                    <a class="btn secondary" href="{{ route('student.meal-plans.show', [$patient, $mealPlan]) }}">Visualizar</a>
                    <a class="btn secondary" href="{{ route('nutrition.meal-plans.edit', [$patient, $mealPlan]) }}">Editar</a>

                    <form class="inline-form" method="POST" action="{{ route('nutrition.meal-plans.destroy', [$patient, $mealPlan]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn danger" type="submit">Excluir</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="notice">Nenhum plano alimentar cadastrado para este aluno.</p>
        @endforelse
        </section>
    </main>
</body>
</html>
