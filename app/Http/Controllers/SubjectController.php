<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $subjects = Subject::all();

        return response()->json([
            'subjects' => $subjects
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubjectRequest $request)
    {
        $validation = $request->validated();

        $newSubject = new Subject([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
        ]);

        $newSubject->save();
        $newSubject->group()->attach($request->group_id, [
            'subject_id' => $newSubject->id
        ]);

        return response()->json([
            'subject' => $newSubject
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
        $subject = Subject::with(['group', 'teacher'])->where('id', $id)->get();

        if (!$subject) {
            return response()->json([
                'message' => 'Student does not exist'
            ], 400);
        }

        return response()->json([
            'subject' => $subject
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSubjectRequest $request, $id)
    {
        $validation = $request->validated();

        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json([
                'message' => 'Subject does not exist'
            ], 400);
        }

        $requestGroupId = $request->group_id;

        if ($requestGroupId) {
            $subject->group()->detach();

            $subject->group()->attach($requestGroupId);
        }

        $subject->update($request->all());
        $subject->save();

        return response()->json([
            'subject' => $subject
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json([
                'message' => 'Subject does not exist'
            ], 400);
        }

        $subject->delete();

        return response()->json([
            'message' => 'Subject deleted'
        ], 200);
    }
}
