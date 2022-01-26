<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(): JsonResponse {
        $students = Student::all();

        return response()->json([
            'students' => $students
        ], 200);
    }

    public function store(Request $request): JsonResponse {
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
        ]);
    }

    public function edit(Request $request, $id): JsonResponse {
        $this->validate($request, [
            'firstname' => 'string',
            'lastname' => 'string',
            'date_of_birth' => 'date|date_format:Y-m-d',
            'date_of_enroll' => 'date|date_format:Y-m-d',
            'credits' => 'integer',
            'group_id' => 'int'
        ]);

        $student = Student::findOrFail($id);

        $student->update($request->all());
        $student->save();

        return response()->json([
           'student' => $student
        ]);
    }

    public function delete($id): JsonResponse {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student does not exist'
            ]);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted'
        ]);
    }
}
