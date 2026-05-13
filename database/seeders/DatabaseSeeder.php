<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Nutricionista Demo',
            'email' => 'nutri@example.com',
            'password' => Hash::make('password'),
            'role' => 'nutritionist',
        ]);

        Patient::create([
            'full_name' => 'Carla Souza',
            'age' => 28,
            'goal' => 'Definicao corporal',
        ]);
    }
}
