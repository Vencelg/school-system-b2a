<?php

namespace App\Http\Middleware;

use App\Http\Requests\StudentGraduateRequest;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;

class HasEnoughCredits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $student = Student::find($request->student_id);

        if (!($student instanceof Student)) {
            return response()->json([
                'error' => 'Student does not exist',
            ]);
        }

        if ($student->credits < 180) {
            return response()->json([
                'error' => 'Student has to have at least 180 credits before finishing studying',
            ]);
        }

        return $next($request);
    }
}
