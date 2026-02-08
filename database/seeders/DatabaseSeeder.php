<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Exercise;
use App\Models\Routine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios de prueba
        $users = User::factory(5)->create();

        // Crear categorías musculares
        $categories = Category::insert([
            ['name' => 'Pecho', 'icon_path' => 'icons/chest.png'],
            ['name' => 'Espalda', 'icon_path' => 'icons/back.png'],
            ['name' => 'Pierna', 'icon_path' => 'icons/leg.png'],
        ]);

        // Obtenerlas como modelos
        $categories = Category::all();

        // Crear ejercicios asociados a categorías
        $exercises = Exercise::factory(10)->create();

        // Crear rutinas con lógica compleja
        Routine::factory(5)->create()->each(function ($routine) use ($users, $exercises) {

            // 1. Asignar la rutina a usuarios aleatorios (routine_user)
            $routine->users()->attach(
                $users->random(2)->pluck('id')
            );

            // 2. Asignar ejercicios con datos de la tabla pivote
            foreach ($exercises->random(3) as $index => $exercise) {
                $routine->exercises()->attach($exercise->id, [
                    'sequence' => $index + 1,
                    'target_sets' => rand(3, 5),
                    'target_reps' => rand(8, 12),
                    'rest_seconds' => rand(60, 120),
                ]);
            }
        });
    }
}
