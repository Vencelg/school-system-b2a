<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $students = Student::all();

        return response()->json([
            'students' => $students
        ], 200);
    }

    public function store(Request $request): JsonResponse {
        $validate = $this->validate($request, [
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'date_of_birth' => 'date|required',
            'date_of_enroll' => 'date|required',
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
}
