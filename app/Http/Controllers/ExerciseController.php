<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function index()
    {
        return view('exercises.index', [
            'exercises' => Exercise::with('category')->get()
        ]);
    }
}

