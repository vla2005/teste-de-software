<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealPlanRequest;
use App\Models\MealPlan;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MealPlanController extends Controller
{
    public function index(Patient $patient): View
    {
        $this->ensureNutritionist();

        return view('meal-plans.index', [
            'patient' => $patient,
            'mealPlans' => $patient->mealPlans()->with('meals')->latest('plan_date')->get(),
        ]);
    }

    public function create(Patient $patient): View
    {
        $this->ensureNutritionist();

        return view('meal-plans.create', [
            'patient' => $patient,
        ]);
    }

    public function store(StoreMealPlanRequest $request, Patient $patient): RedirectResponse
    {
        $this->ensureNutritionist();

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

    public function edit(Patient $patient, MealPlan $mealPlan): View
    {
        $this->ensureNutritionist();
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);

        return view('meal-plans.edit', [
            'patient' => $patient,
            'mealPlan' => $mealPlan->load('meals'),
        ]);
    }

    public function update(StoreMealPlanRequest $request, Patient $patient, MealPlan $mealPlan): RedirectResponse
    {
        $this->ensureNutritionist();
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);

        $mealPlan->update($request->safe()->only([
            'plan_date',
            'notes',
        ]));

        $mealPlan->meals()->delete();

        foreach ($request->validated('meals') as $meal) {
            $mealPlan->meals()->create($meal);
        }

        return redirect()
            ->route('student.meal-plans.show', [$patient, $mealPlan])
            ->with('status', 'Plano alimentar atualizado com sucesso.');
    }

    public function destroy(Patient $patient, MealPlan $mealPlan): RedirectResponse
    {
        $this->ensureNutritionist();
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);

        $mealPlan->delete();

        return redirect()
            ->route('nutrition.meal-plans.index', $patient)
            ->with('status', 'Plano alimentar excluido com sucesso.');
    }

    public function show(Patient $patient, MealPlan $mealPlan): View
    {
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);
        $this->ensureUserCanViewPatientPlan($patient);

        return view('meal-plans.show', [
            'patient' => $patient,
            'mealPlan' => $mealPlan->load('meals'),
        ]);
    }

    private function ensureMealPlanBelongsToPatient(Patient $patient, MealPlan $mealPlan): void
    {
        abort_unless($mealPlan->patient_id === $patient->id, 404);
    }

    private function ensureUserCanViewPatientPlan(Patient $patient): void
    {
        $user = Auth::user();

        abort_unless(
            $user?->role === 'nutritionist' || $patient->user_id === $user?->id,
            403
        );
    }

    private function ensureNutritionist(): void
    {
        abort_unless(Auth::user()?->role === 'nutritionist', 403);
    }
}
