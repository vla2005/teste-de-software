# NutriTreino

Sistema Laravel desenvolvido para a atividade da faculdade, materializando a HU01: **Prescrever plano alimentar**.

A funcionalidade implementada permite que um nutricionista cadastre um plano alimentar para um aluno/paciente, informe refeicoes, alimentos e orientacoes, e disponibilize o plano para visualizacao na area do aluno.

## Tecnologias

- PHP 8.3 ou superior
- Laravel 13
- Composer
- MySQL
- PHPUnit
- Node.js e npm, caso queira compilar os assets do front-end

## Pre-requisitos

Antes de iniciar, instale:

- PHP 8.3+
- Composer
- MySQL Server
- Node.js e npm
- Git

Verifique as instalacoes:

```bash
php -v
composer -V
mysql --version
node -v
npm -v
git --version
```

## 1. Clonar o repositorio

Clone o projeto do GitHub ou GitLab:

```bash
git clone https://github.com/vla2005/teste-de-software.git
cd nutritreino
```

## 2. Instalar dependencias do PHP

Instale as dependencias do Laravel:

```bash
composer install
```

## 3. Instalar dependencias do Node

Instale as dependencias JavaScript:

```bash
npm install
```

Para compilar os assets:

```bash
npm run build
```

Durante o desenvolvimento, tambem e possivel usar:

```bash
npm run dev
```

## 4. Configurar o arquivo `.env`

Copie o arquivo de exemplo:

```bash
copy .env.example .env
```

No Linux/macOS, use:

```bash
cp .env.example .env
```

Depois, gere a chave da aplicacao:

```bash
php artisan key:generate
```

Abra o arquivo `.env` e configure o banco MySQL com o nome `nutritreino`:

```env
APP_NAME=NutriTreino
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nutritreino
DB_USERNAME=root
DB_PASSWORD=
```

Se o seu MySQL usa senha, preencha `DB_PASSWORD`:

```env
DB_PASSWORD=sua_senha
```

## 5. Criar o banco de dados MySQL

Entre no MySQL:

```bash
mysql -u root -p
```

Crie o banco:

```sql
CREATE DATABASE nutritreino CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Saia do MySQL:

```sql
exit;
```

## 6. Rodar as migrations

Com o banco configurado, execute:

```bash
php artisan migrate
```

Esse comando cria as tabelas do Laravel e as tabelas da funcionalidade de plano alimentar:

- `patients`
- `meal_plans`
- `meal_plan_meals`

## 7. Rodar a aplicacao

Inicie o servidor local:

```bash
php artisan serve
```

Acesse no navegador:

```text
http://localhost:8000
```

## 8. Rodar os testes

O projeto usa PHPUnit via Laravel.

Para executar todos os testes:

```bash
composer test
```

Tambem e possivel rodar diretamente:

```bash
php artisan test
```

## Testes implementados

Foram criados testes baseados na HU01: **Prescrever plano alimentar**.

Arquivo de testes de unidade:

```text
tests/Unit/StoreMealPlanRequestTest.php
```

Testes:

- Verifica que o plano alimentar exige data e pelo menos uma refeicao.
- Verifica que cada refeicao exige nome e descricao dos alimentos.

Arquivo de testes de sistema/regressao/end to end:

```text
tests/Feature/MealPlanPrescriptionTest.php
```

Testes:

- Verifica se a tela de prescricao exibe dados basicos do aluno e campos do plano.
- Verifica se o sistema bloqueia salvamento com campos obrigatorios em branco.
- Verifica o fluxo completo: cadastrar plano alimentar e visualizar na area do aluno.
- Verifica se um plano alimentar nao e exibido para aluno diferente do vinculado.

Ao executar `composer test`, o resultado esperado e semelhante a:

```text
Tests: 8 passed
```

## Funcionalidade HU01

Historia de usuario:

> Como nutricionista, quero prescrever um plano alimentar personalizado para um aluno/paciente, para que eu possa registrar e organizar a dieta recomendada, permitindo que o aluno visualize e siga as orientacoes nutricionais de forma centralizada na plataforma.

Principais criterios atendidos:

- Exibir dados basicos do aluno/paciente.
- Permitir cadastro da data do plano alimentar.
- Permitir cadastro de refeicoes.
- Exigir pelo menos uma refeicao.
- Exigir descricao dos alimentos.
- Salvar o plano vinculado ao aluno/paciente.
- Disponibilizar o plano para visualizacao do aluno.
- Impedir visualizacao quando o plano nao pertence ao aluno informado.

## Rotas principais

Tela de prescricao do plano alimentar:

```text
GET /nutrition/patients/{patient}/meal-plans/create
```

Salvar plano alimentar:

```text
POST /nutrition/patients/{patient}/meal-plans
```

Visualizar plano na area do aluno:

```text
GET /student/patients/{patient}/meal-plans/{mealPlan}
```

## Comandos uteis

Limpar cache de configuracao:

```bash
php artisan config:clear
```

Limpar cache geral:

```bash
php artisan optimize:clear
```

Recriar banco do zero:

```bash
php artisan migrate:fresh
```

Recriar banco e rodar testes:

```bash
php artisan migrate:fresh
composer test
```

## Observacao sobre ambiente de testes

No arquivo `phpunit.xml`, os testes usam SQLite em memoria:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Isso significa que os testes nao alteram o banco MySQL `nutritreino`. O MySQL e usado para executar a aplicacao localmente; os testes criam um banco temporario em memoria durante a execucao.
