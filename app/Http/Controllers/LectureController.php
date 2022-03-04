<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendLectureRequest;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLectureRequest $request)
    {
        $validation = $request->validated();

        $newExercise = new Lecture([
            'name' => $request->name,
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
        $lecture = Lecture::find($id);

        if (!($lecture instanceof Lecture)) {
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLectureRequest $request, $id)
    {
        $validation = $request->validated();

        $lecture = Lecture::find($id);

        if (!($lecture instanceof Lecture)) {
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $lecture = Lecture::find($id);

        if (!($lecture instanceof Lecture)) {
            return response()->json([
                'message' => 'Lecture does not exist'
            ], 400);
        }

        $lecture->delete();

        return response()->json([
            'message' => 'Lecture deleted'
        ], 200);
    }

    public function attendLecture(AttendLectureRequest $request)
    {
        $studentId = $request->student_id;
        $lectureId = $request->lecture_id;

        $student = Student::find($studentId);
        $lecture = Lecture::find($lectureId);

        if (!($student instanceof Student)) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        if (!($lecture instanceof Lecture)) {
            return response()->json([
                'message' => 'Lecture does not exist'
            ], 400);
        }

        $studentName = $student->firstname . ' ' . $student->lastname;

        return response()->json([
            'message' => 'Student ' . $studentName . ' completed the ' . $lecture->name . ' lecture'
        ], 200);
    }
}
