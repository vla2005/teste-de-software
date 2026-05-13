<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\PatientController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', fn () => view('dashboard', [
        'patients' => Patient::query()->orderBy('full_name')->get(),
    ]))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    Route::get('/nutrition/patients/{patient}/meal-plans', [MealPlanController::class, 'index'])
        ->name('nutrition.meal-plans.index');

    Route::get('/nutrition/patients/{patient}/meal-plans/create', [MealPlanController::class, 'create'])
        ->name('nutrition.meal-plans.create');

    Route::post('/nutrition/patients/{patient}/meal-plans', [MealPlanController::class, 'store'])
        ->name('nutrition.meal-plans.store');

    Route::get('/nutrition/patients/{patient}/meal-plans/{mealPlan}/edit', [MealPlanController::class, 'edit'])
        ->name('nutrition.meal-plans.edit');

    Route::put('/nutrition/patients/{patient}/meal-plans/{mealPlan}', [MealPlanController::class, 'update'])
        ->name('nutrition.meal-plans.update');

    Route::delete('/nutrition/patients/{patient}/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])
        ->name('nutrition.meal-plans.destroy');

    Route::get('/student/patients/{patient}/meal-plans/{mealPlan}', [MealPlanController::class, 'show'])
        ->name('student.meal-plans.show');
});
