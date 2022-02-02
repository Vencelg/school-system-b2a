<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Models\Student;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $exercises = Exercise::all();

        return response()->json([
            'exercises' => $exercises
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreExerciseRequest $request)
    {
        $validation = $request->validated();

        $newExercise = new Exercise([
            'name' => $request->name,
            'own_computer' => $request->own_computer,
            'deadline_date' => $request->deadline_date
        ]);

        $newExercise->save();

        return response()->json([
            'exercise' => $newExercise
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'message' => 'Exercise does not exist'
            ], 400);
        }

        return response()->json([
            'exercise' => $exercise
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateExerciseRequest $request, $id)
    {
        $validation = $request->validated();

        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'message' => 'Exercise does not exist'
            ], 400);
        }

        $exercise->update($request->all());
        $exercise->save();

        return response()->json([
            'exercise' => $exercise
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'message' => 'Exercise does not exist'
            ], 400);
        }

        $exercise->delete();

        return response()->json([
            'message' => 'Exercise deleted'
        ], 200);
    }
}
