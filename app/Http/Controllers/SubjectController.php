<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(): JsonResponse {
        $subjects = Subject::all();

        return $this->response([
            'subjects' => $subjects
        ], 200);
    }

    public function store(Request $request): JsonResponse {
        $this->validate($request, [
            'name' => 'string|required',
            'teacher_id' => 'integer|required',
            'group_id' => 'integer|required',
        ]);

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

    public function edit(Request $request, $id): JsonResponse {
        $this->validate($request, [
            'name' => 'string',
            'teacher_id' => 'integer',
        ]);

        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json([
                'message' => 'Subject does not exist'
            ], 400);
        }

        $subject->update($request->all());
        $subject->save();

        return response()->json([
            'subject' => $subject
        ]);
    }

    public function delete($id): JsonResponse {
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
