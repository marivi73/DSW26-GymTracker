<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\RoutineController;
use App\Http\Controllers\Api\MyRoutineController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/exercises', [CategoryController::class, 'exercises']);

Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);

Route::get('/routines/public', [RoutineController::class, 'publicIndex']);
Route::get('/routines/{routine}', [RoutineController::class, 'show']);
Route::get('/routines/{routine}/exercises', [RoutineController::class, 'exercises']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::post('/exercises', [ExerciseController::class, 'store']);
    Route::put('/exercises/{exercise}', [ExerciseController::class, 'update']);
    Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy']);

    Route::get('/routines', [RoutineController::class, 'index']);
    Route::post('/routines', [RoutineController::class, 'store']);
    Route::put('/routines/{routine}', [RoutineController::class, 'update']);
    Route::delete('/routines/{routine}', [RoutineController::class, 'destroy']);

    Route::post('/routines/{routine}/exercises', [RoutineController::class, 'addExercise']);
    Route::delete('/routines/{routine}/exercises/{exercise}', [RoutineController::class, 'removeExercise']);

    Route::get('/my-routines', [MyRoutineController::class, 'index']);
    Route::post('/my-routines', [MyRoutineController::class, 'store']);
    Route::delete('/my-routines/{id}', [MyRoutineController::class, 'destroy']);
});

