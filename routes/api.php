<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\RoutineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MyRoutineController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/routines', [RoutineController::class, 'index']);
    Route::post('/routines', [RoutineController::class, 'store']);
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/exercises', [CategoryController::class, 'exercises']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
});

Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/exercises', [ExerciseController::class, 'store']);
    Route::put('/exercises/{exercise}', [ExerciseController::class, 'update']);
    Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy']);
});

Route::get('/routines', [RoutineController::class, 'index']);
Route::get('/routines/{routine}', [RoutineController::class, 'show']);
Route::get('/routines/{routine}/exercises', [RoutineController::class, 'exercises']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/routines', [RoutineController::class, 'store']);
    Route::put('/routines/{routine}', [RoutineController::class, 'update']);
    Route::delete('/routines/{routine}', [RoutineController::class, 'destroy']);

    Route::post('/routines/{routine}/exercises', [RoutineController::class, 'addExercise']);
    Route::delete('/routines/{routine}/exercises/{exercise}', [RoutineController::class, 'removeExercise']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my-routines', [MyRoutineController::class, 'index']);
    Route::post('/my-routines', [MyRoutineController::class, 'store']);
    Route::delete('/my-routines/{id}', [MyRoutineController::class, 'destroy']);
});

Route::get('/routines', [RoutineController::class, 'publicIndex']);
