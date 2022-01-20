<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $test = Subject::with('teacher')->get();

        return response()->json([
            'teachers' => $test
        ], 200);
    }
}
