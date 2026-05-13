# NutriTreino

Sistema Laravel desenvolvido para o trabalho final de Teste de Software. O projeto materializa a plataforma de acompanhamento nutricional e fisico, com foco na HU01: prescrever plano alimentar para um aluno/paciente.

## Funcionalidades

- Login e logout de usuario.
- Painel com alunos/pacientes cadastrados.
- CRUD web de planos alimentares: listar, cadastrar, visualizar, editar e excluir.
- API JSON para planos alimentares.
- Banco de dados com usuarios, pacientes, planos e refeicoes.
- Testes unitarios, testes de API e testes de fluxo fim a fim via PHPUnit/Laravel Feature.

## Tecnologias

- PHP 8.3+
- Laravel 13
- Composer
- MySQL para execucao local
- SQLite em memoria para testes automatizados
- PHPUnit
- Vite/Tailwind, caso os assets sejam compilados

## Instalar

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

Configure o banco no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nutritreino
DB_USERNAME=root
DB_PASSWORD=
```

Depois execute:

```bash
php artisan migrate --seed
```

Usuario demo:

```text
E-mail: nutri@example.com
Senha: password
```

## Rodar

```bash
php artisan serve
```

Acesse:

```text
http://localhost:8000
```

## Rotas Web Principais

```text
GET    /login
POST   /login
POST   /logout
GET    /dashboard
GET    /nutrition/patients/{patient}/meal-plans
GET    /nutrition/patients/{patient}/meal-plans/create
POST   /nutrition/patients/{patient}/meal-plans
GET    /nutrition/patients/{patient}/meal-plans/{mealPlan}/edit
PUT    /nutrition/patients/{patient}/meal-plans/{mealPlan}
DELETE /nutrition/patients/{patient}/meal-plans/{mealPlan}
GET    /student/patients/{patient}/meal-plans/{mealPlan}
```

## API

```text
GET    /api/patients/{patient}/meal-plans
POST   /api/patients/{patient}/meal-plans
GET    /api/patients/{patient}/meal-plans/{mealPlan}
PUT    /api/patients/{patient}/meal-plans/{mealPlan}
DELETE /api/patients/{patient}/meal-plans/{mealPlan}
```

Exemplo de payload:

```json
{
  "plan_date": "2026-04-28",
  "notes": "Beber agua ao longo do dia.",
  "meals": [
    {
      "name": "Cafe da manha",
      "time": "07:30",
      "description": "Ovos mexidos, banana e aveia.",
      "instructions": "Evitar acucar no cafe."
    }
  ]
}
```

## Testes

```bash
composer test
```

Tambem pode ser usado:

```bash
php artisan test
```

Cobertura implementada:

- `tests/Unit/StoreMealPlanRequestTest.php`: validacoes unitarias da requisicao.
- `tests/Feature/AuthTest.php`: login com sucesso e falha de autenticacao.
- `tests/Feature/ApiMealPlanTest.php`: criacao, listagem, validacao, atualizacao e exclusao via API.
- `tests/Feature/MealPlanPrescriptionTest.php`: fluxo web autenticado, validacoes, visualizacao, atualizacao, exclusao e seguranca de vinculo entre aluno e plano.

## Documentacao

O relatorio final do trabalho esta em:

```text
docs/relatorio-final.md
```
