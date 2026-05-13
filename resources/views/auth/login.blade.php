<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - NutriTreino</title>
    <link rel="stylesheet" href="{{ asset('nutritreino.css') }}">
</head>
<body>
    <main class="narrow-page">
        <section class="form-panel">
            <h1>Login</h1>
            <p class="lead">Acesse o painel para gerenciar planos alimentares.</p>

            @if ($errors->any())
                <div class="notice error" role="alert">
                    Nao foi possivel acessar com os dados informados.
                </div>
            @endif

            <form class="stack section" method="POST" action="{{ route('login.store') }}">
                @csrf

                <label>
                    E-mail
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                </label>

                <label>
                    Senha
                    <input type="password" name="password" required>
                </label>

                <label>
                    <span>
                        <input type="checkbox" name="remember" value="1" style="min-height:auto; width:auto;">
                        Manter conectado
                    </span>
                </label>

                <button class="btn" type="submit">Entrar</button>
            </form>
        </section>
    </main>
</body>
</html>
