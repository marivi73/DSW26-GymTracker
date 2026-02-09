<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        return Exercise::with('category')->get();
    }

    public function show(Exercise $exercise)
    {
        return $exercise->load('category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'instruction' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        return Exercise::create($request->all());
    }

    public function update(Request $request, Exercise $exercise)
    {
        $exercise->update($request->all());
        return $exercise;
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->noContent();
    }
}
