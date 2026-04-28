<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plano alimentar do aluno</title>
</head>
<body>
    <main>
        <h1>Plano alimentar</h1>

        @if (session('status'))
            <p role="status">{{ session('status') }}</p>
        @endif

        <section aria-label="Dados do aluno">
            <h2>{{ $patient->full_name }}</h2>
            <p>Idade: {{ $patient->age }}</p>
            <p>Objetivo: {{ $patient->goal }}</p>
        </section>

        <p>Data do plano: {{ $mealPlan->plan_date->format('d/m/Y') }}</p>

        @foreach ($mealPlan->meals as $meal)
            <article>
                <h2>{{ $meal->name }}</h2>
                @if ($meal->time)
                    <p>Horario: {{ substr($meal->time, 0, 5) }}</p>
                @endif
                <p>{{ $meal->description }}</p>
                @if ($meal->instructions)
                    <p>{{ $meal->instructions }}</p>
                @endif
            </article>
        @endforeach
    </main>
</body>
</html>
