<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $groups = Group::with('subjects')->get();
        $subjectsWithLectures = Subject::with('lectures')->get();
        $subjectsWithExercises = Subject::with('exercises')->get();

        return response()->json([
            'subjects' => $subjectsWithExercises
            //'groups' => $groups
        ], 200);
    }
}
