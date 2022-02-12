<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $teachers = Teacher::all();

        return response()->json([
            'teachers' => $teachers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTeacherRequest $request)
    {
        $validation = $request->validated();

        $newTeacher = new Student([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'date_of_enroll' => $request->date_of_enroll,
        ]);

        $newTeacher->save();
        $newTeacher->group()->attach($request->group_id);

        return response()->json([
            'teacher' => $newTeacher
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
        $teacher = Teacher::with('subject')->where('id', $id)->get();

        if (!($teacher instanceof Teacher)) {
            return response()->json([
                'message' => 'Teacher does not exist'
            ], 400);
        }

        return response()->json([
            'teacher' => $teacher
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTeacherRequest $request, $id)
    {
        $validation = $request->validated();

        $teacher = Teacher::find($id);

        if (!($teacher instanceof Teacher)) {
            return response()->json([
                'message' => 'Teacher does not exist'
            ], 400);
        }

        $teacher->update($request->all());
        $teacher->save();

        return response()->json([
            'teacher' => $teacher
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
        $teacher = Teacher::find($id);

        if (!($teacher instanceof Teacher)) {
            return response()->json([
                'message' => 'Teacher does not exist'
            ], 400);
        }

        $teacher->delete();

        return response()->json([
            'message' => 'Teacher deleted'
        ], 200);
    }
}
