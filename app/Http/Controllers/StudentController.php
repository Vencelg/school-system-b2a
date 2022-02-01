<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = Student::all();

        return response()->json([
            'students' => $students
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'date_of_birth' => 'date|required|date_format:Y-m-d',
            'date_of_enroll' => 'date|required|date_format:Y-m-d',
            'group_id' => 'int|required'
        ]);

        $newStudent = new Student([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'date_of_enroll' => $request->date_of_enroll,
        ]);

        $newStudent->save();
        $newStudent->group()->attach($request->group_id, [
            'student_id' => $newStudent->id
        ]);

        return response()->json([
            'student' => $newStudent
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
        $student = Student::with('group')->where('id', $id)->get();

        if (!$student) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        return response()->json([
            'student' => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'string',
            'lastname' => 'string',
            'date_of_birth' => 'date|date_format:Y-m-d',
            'date_of_enroll' => 'date|date_format:Y-m-d',
            'credits' => 'integer',
            'group_id' => 'int'
        ]);

        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Subject does not exist'
            ], 400);
        }

        $student->update($request->all());
        $student->save();

        return response()->json([
            'student' => $student
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
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted'
        ], 200);
    }
}
