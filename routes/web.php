<?php

use App\Http\Controllers\MealPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nutrition/patients/{patient}/meal-plans/create', [MealPlanController::class, 'create'])
    ->name('nutrition.meal-plans.create');

Route::post('/nutrition/patients/{patient}/meal-plans', [MealPlanController::class, 'store'])
    ->name('nutrition.meal-plans.store');

Route::get('/student/patients/{patient}/meal-plans/{mealPlan}', [MealPlanController::class, 'show'])
    ->name('student.meal-plans.show');
