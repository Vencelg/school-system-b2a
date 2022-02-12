<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompletePrerequisiteRequest;
use App\Http\Requests\StorePrerequisiteRequest;
use App\Http\Requests\UpdatePrerequisiteRequest;
use App\Models\Prerequisite;
use App\Models\Student;
use Illuminate\Http\Request;

class PrerequisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $prerequisites = Prerequisite::all();

        return response()->json([
            'prerequisites' => $prerequisites
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePrerequisiteRequest $request)
    {
        $validation = $request->validated();

        $newPrerequisite = new Prerequisite([
            'name' => $request->name,
            'deadline_date' => $request->deadline_date,
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
        ]);

        $newPrerequisite->save();

        return response()->json([
            'prerequisite' => $newPrerequisite
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
        $prerequisite = Prerequisite::find($id);

        if (!($prerequisite instanceof Prerequisite)) {
            return response()->json([
                'message' => 'Prerequisite does not exist'
            ], 400);
        }

        return response()->json([
            'prerequisite' => $prerequisite
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePrerequisiteRequest $request, $id)
    {
        $validation = $request->validated();

        $prerequisite = Prerequisite::find($id);

        if (!($prerequisite instanceof Prerequisite)) {
            return response()->json([
                'message' => 'Prerequisite does not exist'
            ], 400);
        }

        $prerequisite->update($request->all());
        $prerequisite->save();

        return response()->json([
            'prerequisite' => $prerequisite
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
        $prerequisite = Prerequisite::find($id);

        if (!($prerequisite instanceof Prerequisite)) {
            return response()->json([
                'message' => 'Prerequisite does not exist'
            ], 400);
        }

        $prerequisite->delete();

        return response()->json([
            'message' => 'Prerequisite deleted'
        ], 200);
    }

    public function completePrerequisite(CompletePrerequisiteRequest $request) {
        $studentId = $request->student_id;
        $prerequisiteId = $request->prerequisite_id;


        $student = Student::find($studentId);
        $prerequisite = Prerequisite::find($prerequisiteId);

        if (!($student instanceof Student)) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        if (!($prerequisite instanceof Prerequisite)) {
            return response()->json([
                'message' => 'Prerequisite does not exist'
            ], 400);
        }

        $prerequisite->delete();

        $studentName = $student->firstname.' '.$student->lastname;

        return response()->json([
            'message' => 'Student '.$studentName.' completed the '.$prerequisite->name.' prerequisite'
        ], 200);
    }
}
