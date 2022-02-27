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
    'teachers' => \App\Http\Controllers\TeacherController::class,
    'exercises' => \App\Http\Controllers\ExerciseController::class,
    'lectures' => \App\Http\Controllers\LectureController::class,
    'prerequisites' => \App\Http\Controllers\PrerequisiteController::class,
]);

Route::get('students/{id}/subjects', [\App\Http\Controllers\StudentController::class, 'showSubjects']);
Route::get('students/sortBy/{sorter}', [\App\Http\Controllers\StudentController::class, 'studentSort']);
Route::post('students/graduate', [\App\Http\Controllers\StudentController::class, 'graduate'])->middleware(['hasNoPrerequisites', 'hasEnoughCredits']);
Route::post('lectures/attend', [\App\Http\Controllers\LectureController::class, 'attendLecture']);
Route::post('exercises/complete', [\App\Http\Controllers\ExerciseController::class, 'completeExercise']);
Route::post('prerequisites/complete', [\App\Http\Controllers\PrerequisiteController::class, 'completePrerequisite']);

