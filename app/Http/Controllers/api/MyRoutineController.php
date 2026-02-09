<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyRoutineController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->routines;
    }

    public function store(Request $request)
    {
        $request->validate([
            'routine_id' => 'required|exists:routines,id'
        ]);

        $request->user()->routines()->attach($request->routine_id);
        return response()->json(['message' => 'Suscripción realizada']);
    }

    public function destroy(Request $request, $id)
    {
        $request->user()->routines()->detach($id);
        return response()->json(['message' => 'Desuscripción realizada']);
    }
}

