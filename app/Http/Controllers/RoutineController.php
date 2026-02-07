<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\RoutineResource;
use App\Http\Requests\StoreRoutineRequest;
use App\Models\Routine;

class RoutineController extends Controller
{
    // Listar todas las rutinas del usuario autenticado
    public function index(Request $request)
    {
        $user = $request->user();

        // return response()->json(
        //     $user->routines
        // );

        // Usamos Resource para consistencia con show()
        return RoutineResource::collection($user->routines);
    }

    // Crear una nueva rutina y asociarla a usuario y ejercicios
    public function store(StoreRoutineRequest $request)
    {
        // 1. Crear la rutina
        $routine = Routine::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
        ]);

        // 2. Asociar la rutina al usuario autenticado
        $request->user()->routines()->attach($routine->id);

        // 3. Asociar los ejercicios a la rutina
        foreach ($request->exercises as $exercise) {
            $routine->exercises()->attach($exercise['id'], [
                'sequence' => $exercise['sequence'] ?? 1,
                'target_sets' => $exercise['target_sets'],
                'target_reps' => $exercise['target_reps'],
                'rest_seconds' => $exercise['rest_seconds'],
            ]);
        }

        // Devolver rutina creada
        return response()->json($routine, 201);
    }

    // Detalle completo de una rutina con sus ejercicios
        public function show(Routine $routine)
    {
        return new RoutineResource(
            $routine->load('exercises')
        );
    }

    // PUT /routines/{id}
    public function update(Request $request, Routine $routine)
    {
        $routine->update($request->only('name', 'description'));
        return $routine;
    }

    // DELETE /routines/{id}
    public function destroy(Routine $routine)
    {
        $routine->delete();
        return response()->noContent();
    }

    // GET /routines/{id}/exercises
    public function exercises(Routine $routine)
    {
        return $routine->exercises;
    }

    // POST /routines/{id}/exercises
    public function addExercise(Request $request, Routine $routine)
    {
        $routine->exercises()->attach($request->exercise_id, [
            'target_sets' => $request->sets,
            'target_reps' => $request->reps,
            'rest_seconds' => $request->rest_seconds,
        ]);

        return response()->json(['message' => 'Ejercicio añadido']);
    }

    // DELETE /routines/{id}/exercises/{e_id}
    public function removeExercise(Routine $routine, $e_id)
    {
        $routine->exercises()->detach($e_id);
        return response()->json(['message' => 'Ejercicio eliminado']);
    }
}
