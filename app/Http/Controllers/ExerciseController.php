<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteExerciseRequest;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreExerciseRequest $request)
    {
        $validation = $request->validated();

        $newExercise = new Exercise([
            'name' => $request->name,
            'own_computer' => $request->own_computer,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
        ]);

        $newExercise->save();

        return response()->json([
            'exercise' => $newExercise
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $exercise = Exercise::find($id);

        if (!($exercise instanceof Exercise)) {
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateExerciseRequest $request, $id)
    {
        $validation = $request->validated();

        $exercise = Exercise::find($id);

        if (!($exercise instanceof Exercise)) {
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $exercise = Exercise::find($id);

        if (!($exercise instanceof Exercise)) {
            return response()->json([
                'message' => 'Exercise does not exist'
            ], 400);
        }

        $exercise->delete();

        return response()->json([
            'message' => 'Exercise deleted'
        ], 200);
    }

    /**
     * Complete the specified exercise.
     *
     * @param int $studentId
     * @param int $exerciseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function completeExercise(CompleteExerciseRequest $request)
    {
        $studentId = $request->student_id;
        $exerciseId = $request->exercise_id;

        $student = Student::find($studentId);
        if (!($student instanceof Student)) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        $exercise = Exercise::find($exerciseId);
        if (!($exercise instanceof Exercise)) {
            return response()->json([
                'message' => 'Exercise does not exist'
            ], 400);
        }

        $student->update([
            'credits' => $student->credits + $exercise->credits_to_give,
        ]);
        $student->save();
        
        $studentName = $student->firstname . ' ' . $student->lastname;

        return response()->json([
            'message' => 'Student ' . $studentName . ' completed the ' . $exercise->name . ' exercise'
        ], 200);
    }
}
