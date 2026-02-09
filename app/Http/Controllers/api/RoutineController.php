<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoutineRequest;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function publicIndex()
    {
        return RoutineResource::collection(
            Routine::with('exercises')->get()
        );
    }

    public function index(Request $request)
    {
        return RoutineResource::collection(
            $request->user()->routines
        );
    }

    public function show(Routine $routine)
    {
        return new RoutineResource(
            $routine->load('exercises')
        );
    }

    public function store(StoreRoutineRequest $request)
    {
        $routine = Routine::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $request->user()->routines()->attach($routine->id);

        foreach ($request->exercises as $exercise) {
            $routine->exercises()->attach($exercise['id'], [
                'sequence' => $exercise['sequence'] ?? 1,
                'target_sets' => $exercise['target_sets'],
                'target_reps' => $exercise['target_reps'],
                'rest_seconds' => $exercise['rest_seconds'],
            ]);
        }

        return response()->json($routine, 201);
    }

    public function update(Request $request, Routine $routine)
    {
        $routine->update($request->only('name', 'description'));
        return $routine;
    }

    public function destroy(Routine $routine)
    {
        $routine->delete();
        return response()->noContent();
    }

    public function exercises(Routine $routine)
    {
        return $routine->exercises;
    }

    public function addExercise(Request $request, Routine $routine)
    {
        $routine->exercises()->attach($request->exercise_id, [
            'target_sets' => $request->sets,
            'target_reps' => $request->reps,
            'rest_seconds' => $request->rest_seconds,
        ]);

        return response()->json(['message' => 'Ejercicio añadido']);
    }

    public function removeExercise(Routine $routine, $exercise)
    {
        $routine->exercises()->detach($exercise);
        return response()->json(['message' => 'Ejercicio eliminado']);
    }
}
