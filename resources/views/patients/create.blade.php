<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar paciente</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('dashboard') }}">NutriTreino</a>
            <nav class="nav-actions">
                <a class="btn secondary" href="{{ route('dashboard') }}">Voltar</a>
            </nav>
        </div>
    </header>

    <main class="page">
        <div class="section-header">
            <div>
                <h1>Cadastrar paciente</h1>
                <p class="lead">Informe os dados basicos do aluno/paciente.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="notice error" role="alert">
                Existem campos obrigatorios nao preenchidos.
            </div>
        @endif

        <form class="form-panel stack" method="POST" action="{{ route('patients.store') }}">
            @csrf

            <div class="form-grid">
                <label>
                    Nome completo
                    <input name="full_name" value="{{ old('full_name') }}" required>
                </label>

                <label>
                    Idade
                    <input type="number" name="age" min="1" max="120" value="{{ old('age') }}" required>
                </label>

                <label class="full">
                    Objetivo
                    <input name="goal" value="{{ old('goal') }}" required>
                </label>
            </div>

            <div class="actions">
                <button class="btn" type="submit">Salvar paciente</button>
                <a class="btn secondary" href="{{ route('dashboard') }}">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
