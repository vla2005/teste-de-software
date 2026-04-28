<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealPlanRequest;
use App\Models\MealPlan;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MealPlanController extends Controller
{
    public function create(Patient $patient): View
    {
        return view('meal-plans.create', [
            'patient' => $patient,
        ]);
    }

    public function store(StoreMealPlanRequest $request, Patient $patient): RedirectResponse
    {
        $mealPlan = $patient->mealPlans()->create($request->safe()->only([
            'plan_date',
            'notes',
        ]));

        foreach ($request->validated('meals') as $meal) {
            $mealPlan->meals()->create($meal);
        }

        return redirect()
            ->route('student.meal-plans.show', [$patient, $mealPlan])
            ->with('status', 'Plano alimentar cadastrado com sucesso.');
    }

    public function show(Patient $patient, MealPlan $mealPlan): View
    {
        abort_unless($mealPlan->patient_id === $patient->id, 404);

        return view('meal-plans.show', [
            'patient' => $patient,
            'mealPlan' => $mealPlan->load('meals'),
        ]);
    }
}
