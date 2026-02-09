<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Routine;

class RoutineController extends Controller
{
    public function index()
    {
        return view('routines.index', [
            'routines' => Routine::all()
        ]);
    }

    public function show(Routine $routine)
    {
        return view('routines.show', compact('routine'));
    }
}

