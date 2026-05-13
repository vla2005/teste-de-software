<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NutriTreino</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ url('/') }}">NutriTreino</a>
            <nav class="nav-actions">
                @auth
                    <a class="btn secondary" href="{{ route('dashboard') }}">Painel</a>
                @else
                    <a class="btn" href="{{ route('login') }}">Entrar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="page hero">
        <section>
            <h1>NutriTreino</h1>
            <p class="lead">Plataforma para acompanhar alunos, organizar prescricoes alimentares e manter orientacoes nutricionais em um unico lugar.</p>
            <div class="actions">
                @auth
                    <a class="btn" href="{{ route('dashboard') }}">Acessar painel</a>
                @else
                    <a class="btn" href="{{ route('login') }}">Entrar no sistema</a>
                @endauth
            </div>
        </section>

        <section class="hero-visual" aria-label="Resumo do sistema">
            <h2>Fluxo principal</h2>
            <table>
                <tr>
                    <td><strong>1</strong></td>
                    <td>Selecionar aluno/paciente</td>
                </tr>
                <tr>
                    <td><strong>2</strong></td>
                    <td>Prescrever refeicoes e orientacoes</td>
                </tr>
                <tr>
                    <td><strong>3</strong></td>
                    <td>Disponibilizar plano para consulta</td>
                </tr>
            </table>
        </section>
    </main>
</body>
</html>
