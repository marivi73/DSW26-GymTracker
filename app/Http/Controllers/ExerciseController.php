<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    // GET /exercises
    public function index()
    {
        return Exercise::all();
    }

    // GET /exercises/{id}
    public function show(Exercise $exercise)
    {
        return $exercise->load('category');
    }

    // POST /exercises
    public function store(Request $request)
    {
        return Exercise::create([
            'name' => $request->name,
            'instruction' => $request->desc,
            'category_id' => $request->cat_id,
        ]);
    }

    // PUT /exercises/{id}
    public function update(Request $request, Exercise $exercise)
    {
        $exercise->update($request->all());
        return $exercise;
    }

    // DELETE /exercises/{id}
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->noContent();
    }
}
