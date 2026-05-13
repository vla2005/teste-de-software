<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('full_name')->nullable();
            $table->unsignedTinyInteger('age');
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 3, 2)->nullable();
            $table->string('goal');
            $table->timestamps();
        });

        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->date('plan_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('meal_plan_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_plan_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->time('time')->nullable();
            $table->text('description');
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meal_plan_meals');
        Schema::dropIfExists('meal_plans');
        Schema::dropIfExists('patients');
    }
};
