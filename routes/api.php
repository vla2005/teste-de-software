<?php

use App\Http\Controllers\Api\MealPlanController;
use Illuminate\Support\Facades\Route;

Route::prefix('patients/{patient}/meal-plans')->name('api.meal-plans.')->group(function (): void {
    Route::get('/', [MealPlanController::class, 'index'])->name('index');
    Route::post('/', [MealPlanController::class, 'store'])->name('store');
    Route::get('/{mealPlan}', [MealPlanController::class, 'show'])->name('show');
    Route::put('/{mealPlan}', [MealPlanController::class, 'update'])->name('update');
    Route::delete('/{mealPlan}', [MealPlanController::class, 'destroy'])->name('destroy');
});
