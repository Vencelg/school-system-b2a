<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('students')->group(function () {
    Route::get('/', [\App\Http\Controllers\StudentController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\StudentController::class, 'store']);
    Route::put('/{id}', [\App\Http\Controllers\StudentController::class, 'edit']);
    Route::delete('/{id}', [\App\Http\Controllers\StudentController::class, 'delete']);
    Route::get('/{id}', [\App\Http\Controllers\StudentController::class, 'show']);
    Route::get('/{id}/schedule', [\App\Http\Controllers\StudentController::class, 'showSubjects']);
});

Route::prefix('subjects')->group(function () {
    Route::get('/', [\App\Http\Controllers\SubjectController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\SubjectController::class, 'store']);
    Route::put('/{id}', [\App\Http\Controllers\SubjectController::class, 'edit']);
    Route::delete('/{id}', [\App\Http\Controllers\SubjectController::class, 'delete']);
});

Route::prefix('groups')->group(function () {
    Route::get('/', [\App\Http\Controllers\GroupController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\GroupController::class, 'store']);
    Route::put('/{id}', [\App\Http\Controllers\GroupController::class, 'edit']);
    Route::delete('/{id}', [\App\Http\Controllers\GroupController::class, 'delete']);
});
