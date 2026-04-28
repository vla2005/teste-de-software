<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MealPlan extends Model
{
    protected $fillable = [
        'patient_id',
        'plan_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'plan_date' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function meals(): HasMany
    {
        return $this->hasMany(MealPlanMeal::class);
    }
}
