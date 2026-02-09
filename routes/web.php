<?php

use App\Http\Controllers\RoutineController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/routines', [RoutineController::class, 'index']);
Route::get('/routines/{routine}', [RoutineController::class, 'show']);

Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
