<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prescrever plano alimentar</title>
</head>
<body>
    <main>
        <h1>Prescrever plano alimentar</h1>

        <section aria-label="Dados do aluno">
            <h2>Dados do aluno</h2>
            <p>Nome completo: {{ $patient->full_name }}</p>
            <p>Idade: {{ $patient->age }}</p>
            <p>Objetivo: {{ $patient->goal }}</p>
        </section>

        @if ($errors->any())
            <div role="alert">
                Existem campos obrigatorios nao preenchidos.
            </div>
        @endif

        <form method="POST" action="{{ route('nutrition.meal-plans.store', $patient) }}">
            @csrf

            <label>
                Data do plano
                <input type="date" name="plan_date" value="{{ old('plan_date') }}" required>
            </label>

            <label>
                Observacoes gerais
                <textarea name="notes">{{ old('notes') }}</textarea>
            </label>

            <fieldset>
                <legend>Refeicao</legend>

                <label>
                    Nome da refeicao
                    <input name="meals[0][name]" value="{{ old('meals.0.name') }}" required>
                </label>

                <label>
                    Horario
                    <input type="time" name="meals[0][time]" value="{{ old('meals.0.time') }}">
                </label>

                <label>
                    Descricao dos alimentos
                    <textarea name="meals[0][description]" required>{{ old('meals.0.description') }}</textarea>
                </label>

                <label>
                    Orientacoes
                    <textarea name="meals[0][instructions]">{{ old('meals.0.instructions') }}</textarea>
                </label>
            </fieldset>

            <button type="submit">Salvar plano alimentar</button>
        </form>
    </main>
</body>
</html>
