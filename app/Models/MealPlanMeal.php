<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MealPlanMeal extends Model
{
    protected $fillable = [
        'name',
        'time',
        'description',
        'instructions',
    ];

    public function mealPlan(): BelongsTo
    {
        return $this->belongsTo(MealPlan::class);
    }
}
