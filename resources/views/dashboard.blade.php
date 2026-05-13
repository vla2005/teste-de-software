<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel - NutriTreino</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('dashboard') }}">NutriTreino</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn secondary" type="submit">Sair</button>
            </form>
        </div>
    </header>

    <main class="page">
        <div class="section-header">
            <div>
                <h1>Painel</h1>
                <p class="lead">Usuario autenticado: {{ auth()->user()->name }}</p>
            </div>
            <a class="btn" href="{{ route('patients.create') }}">Cadastrar paciente</a>
        </div>

        @if (session('status'))
            <p class="notice success" role="status">{{ session('status') }}</p>
        @endif

        <section class="section" aria-label="Alunos e pacientes">
            <div class="section-header">
                <h2>Alunos e pacientes</h2>
                <span class="meta">{{ $patients->count() }} registro(s)</span>
            </div>

            <div class="grid">
            @forelse ($patients as $patient)
                <article class="card">
                    <h3>{{ $patient->full_name }}</h3>
                    <p class="meta">{{ $patient->age }} anos</p>
                    <p>{{ $patient->goal }}</p>
                    <div class="actions">
                        <a class="btn" href="{{ route('nutrition.meal-plans.index', $patient) }}">Gerenciar planos</a>
                        <a class="btn secondary" href="{{ route('patients.edit', $patient) }}">Editar</a>
                        <form class="inline-form" method="POST" action="{{ route('patients.destroy', $patient) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn danger" type="submit">Excluir</button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="notice">Nenhum aluno cadastrado.</p>
            @endforelse
            </div>
        </section>
    </main>
</body>
</html>
