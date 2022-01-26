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

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
Route::get('/students', [\App\Http\Controllers\StudentController::class, 'index']);
Route::post('/students', [\App\Http\Controllers\StudentController::class, 'store']);
Route::put('/students/{id}', [\App\Http\Controllers\StudentController::class, 'edit']);
Route::delete('/students/{id}', [\App\Http\Controllers\StudentController::class, 'delete']);
