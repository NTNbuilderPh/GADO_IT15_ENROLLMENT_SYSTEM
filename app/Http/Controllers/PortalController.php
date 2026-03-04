<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    /**
     * Grades — real-time grade tracking.
     */
    public function grades()
    {
        $student = Auth::guard('student')->user();

        $courses = $student->courses()
                           ->orderBy('course_code')
                           ->get();

        // Separate by status
        $enrolled  = $courses->where('pivot.status', 'enrolled');
        $completed = $courses->where('pivot.status', 'completed');
        $dropped   = $courses->where('pivot.status', 'dropped');

        // GPA calculation (enrolled + completed only)
        $forGpa = $courses->whereIn('pivot.status', ['enrolled', 'completed'])
                          ->filter(fn($c) => $c->pivot->grade !== null);

        $gpa = $forGpa->count() > 0
            ? round($forGpa->sum(fn($c) => $c->pivot->grade * $c->units) / $forGpa->sum('units'), 2)
            : null;

        return view('portal.grades', compact('student', 'enrolled', 'completed', 'dropped', 'gpa'));
    }

    /**
     * Attendance — real-time attendance tracking.
     */
    public function attendance()
    {
        $student = Auth::guard('student')->user();

        $courses = $student->enrolledCourses()
                           ->orderBy('course_code')
                           ->get();

        $avgAttendance = $courses->count() > 0
            ? round($courses->avg('pivot.attendance_percentage'), 1)
            : 100;

        return view('portal.attendance', compact('student', 'courses', 'avgAttendance'));
    }
}