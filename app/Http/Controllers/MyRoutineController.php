<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyRoutineController extends Controller
{
    // GET /my-routines
    public function index(Request $request)
    {
        return $request->user()->routines;
    }

    // POST /my-routines
    public function store(Request $request)
    {
        $request->user()->routines()->attach($request->routine_id);
        return response()->json(['message' => 'Suscripción realizada']);
    }

    // DELETE /my-routines/{id}
    public function destroy(Request $request, $id)
    {
        $request->user()->routines()->detach($id);
        return response()->json(['message' => 'Desuscripción realizada']);
    }
}
