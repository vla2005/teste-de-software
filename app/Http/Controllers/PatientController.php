<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function create(): View
    {
        return view('patients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $patient = Patient::create($this->validatedData($request));

        return redirect()
            ->route('nutrition.meal-plans.index', $patient)
            ->with('status', 'Paciente cadastrado com sucesso.');
    }

    public function edit(Patient $patient): View
    {
        return view('patients.edit', [
            'patient' => $patient,
        ]);
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $patient->update($this->validatedData($request));

        return redirect()
            ->route('nutrition.meal-plans.index', $patient)
            ->with('status', 'Paciente atualizado com sucesso.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Paciente excluido com sucesso.');
    }

    /**
     * @return array{full_name: string, age: int, goal: string}
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'goal' => ['required', 'string', 'max:255'],
        ]);
    }
}
