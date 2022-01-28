<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(): JsonResponse {
        $exercises = Exercise::all();

        return response()->json([
            'Exercises' => $exercises
        ], 200);
    }

    public function store(Request $request, $id): JsonResponse {
        $this->validate($request, [
            'name' => 'string|required',
            'own_computer' => 'boolean|required',
        ]);

        $newExercise = new Exercise([
            'name' => $request->name,
            'own_computer' => $request->own_computer,
        ]);

        $newExercise->save();

        return response()->json([
            'exercise' => $newExercise
        ], 200);
    }
}
