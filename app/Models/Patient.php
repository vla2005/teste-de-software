<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'full_name',
        'age',
        'goal',
    ];

    public function mealPlans(): HasMany
    {
        return $this->hasMany(MealPlan::class);
    }
}
