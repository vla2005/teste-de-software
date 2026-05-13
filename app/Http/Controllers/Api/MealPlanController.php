<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMealPlanRequest;
use App\Models\MealPlan;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MealPlanController extends Controller
{
    public function index(Patient $patient): JsonResponse
    {
        return response()->json([
            'data' => $patient->mealPlans()->with('meals')->latest('plan_date')->get(),
        ]);
    }

    public function store(StoreMealPlanRequest $request, Patient $patient): JsonResponse
    {
        $mealPlan = $patient->mealPlans()->create($request->safe()->only([
            'plan_date',
            'notes',
        ]));

        foreach ($request->validated('meals') as $meal) {
            $mealPlan->meals()->create($meal);
        }

        return response()->json([
            'data' => $mealPlan->load('meals'),
        ], Response::HTTP_CREATED);
    }

    public function show(Patient $patient, MealPlan $mealPlan): JsonResponse
    {
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);

        return response()->json([
            'data' => $mealPlan->load('meals'),
        ]);
    }

    public function update(StoreMealPlanRequest $request, Patient $patient, MealPlan $mealPlan): JsonResponse
    {
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);

        $mealPlan->update($request->safe()->only([
            'plan_date',
            'notes',
        ]));

        $mealPlan->meals()->delete();

        foreach ($request->validated('meals') as $meal) {
            $mealPlan->meals()->create($meal);
        }

        return response()->json([
            'data' => $mealPlan->refresh()->load('meals'),
        ]);
    }

    public function destroy(Patient $patient, MealPlan $mealPlan): Response
    {
        $this->ensureMealPlanBelongsToPatient($patient, $mealPlan);

        $mealPlan->delete();

        return response()->noContent();
    }

    private function ensureMealPlanBelongsToPatient(Patient $patient, MealPlan $mealPlan): void
    {
        abort_unless($mealPlan->patient_id === $patient->id, 404);
    }
}
