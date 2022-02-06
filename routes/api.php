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


Route::apiResources([
    'groups' => \App\Http\Controllers\GroupController::class,
    'subjects' => \App\Http\Controllers\SubjectController::class,
    'students' => \App\Http\Controllers\StudentController::class,
    'exercises' => \App\Http\Controllers\ExerciseController::class,
    'lectures' => \App\Http\Controllers\LectureController::class,
    'prerequisites' => \App\Http\Controllers\PrerequisiteController::class,
]);

Route::get('students/{id}/subjects', [\App\Http\Controllers\StudentController::class, 'showSubjects']);
Route::get('exercises/{studentId}/complete/{exerciseId}', [\App\Http\Controllers\ExerciseController::class, 'completeExercise']);
Route::get('exercises/{studentId}/complete/{prerequisiteId}', [\App\Http\Controllers\PrerequisiteController::class, 'completePrerequisite']);
