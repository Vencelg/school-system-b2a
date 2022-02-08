<?php

namespace App\Http\Middleware;

use App\Http\Requests\StudendGraduateRequest;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;

class HasNoPrerequisites
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $student = Student::with('prerequisites')->where('id', $request->student_id)->get();

        if (!empty($student[0]->prerequisites[0])) {
            return response()->json([
                //'error' => 'Student has to finish his prerequisites before graduation',
                'error' => $student[0]->prerequisites,
            ]);
        }

        return $next($request);
    }
}
