<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $lectures = Lecture::all();

        return response()->json([
            'lectures' => $lectures
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLectureRequest $request)
    {
        $validation = $request->validated();

        $newExercise = new Lecture([
            'name' => $request->name,
            'presentation_date' => $request->presentation_date
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
        $lecture = Lecture::find($id);

        if (!$lecture) {
            return response()->json([
                'message' => 'Lecture does not exist'
            ], 400);
        }

        return response()->json([
            'lecture' => $lecture
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLectureRequest $request, $id)
    {
        $validation = $request->validated();

        $lecture = Lecture::find($id);

        if (!$lecture) {
            return response()->json([
                'message' => 'Lecture does not exist'
            ], 400);
        }

        $lecture->update($request->all());
        $lecture->save();

        return response()->json([
            'lecture' => $lecture
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
        $lecture = Lecture::find($id);

        if (!$lecture) {
            return response()->json([
                'message' => 'Lecture does not exist'
            ], 400);
        }

        $lecture->delete();

        return response()->json([
            'message' => 'Lecture deleted'
        ], 200);
    }
}
