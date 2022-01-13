<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Util\Json;

class TestController extends Controller
{
    public function index() : JsonResponse
    {
        $students = Student::all();

        return response()->json([
            'students' => $students
        ]);
    }
}
