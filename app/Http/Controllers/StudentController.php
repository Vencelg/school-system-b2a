<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StudendGraduateRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Subject;
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
    public function store(StoreStudentRequest $request)
    {
        $validation = $request->validated();

        $newStudent = new Student([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'date_of_enroll' => $request->date_of_enroll,
        ]);

        $newStudent->save();
        $newStudent->group()->attach($request->group_id);

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
    public function update(UpdateStudentRequest $request, $id)
    {
        $validation = $request->validated();

        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Subject does not exist'
            ], 400);
        }
        $requestGroupId = $request->group_id;

        if ($requestGroupId) {
            $student->group()->detach();

            $student->group()->attach($requestGroupId);
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

    public function showSubjects($id)
    {
        $student = Student::with('group')->where('id', $id)->get();

        if (!$student) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        if (empty($student[0]->group[0])) {
            return response()->json([
                'message' => 'bruh'
            ], 400);
        }

        $groupId = $student[0]->group[0]->id;


        $subjects = Subject::with('group')->get();
        $schedule = [];

        foreach ($subjects as $subject) {
            if ($subject->group[0]->id == $groupId) {
                array_push($schedule, $subject);
            }
        }

        return response()->json([
            'subjects' => $schedule
        ], 200);
    }

    public function graduate(StudendGraduateRequest $request)
    {
        $student = Student::find($request->student_id);

        $student->grade += 1;
        $student->credits -= 30;
        $student->save();

        return response()->json([
            'student' => $student
        ], 200);
    }
}
