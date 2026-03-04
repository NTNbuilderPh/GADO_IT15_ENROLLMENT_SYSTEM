<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Academic Portal Dashboard — real-time overview.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Eager-load enrolled courses
        $student->load('enrolledCourses');

        // Compute dashboard metrics
        $enrolledCourses  = $student->enrolledCourses;
        $totalUnits       = $enrolledCourses->sum('units');
        $unreadMessages   = $student->messages()->where('is_read', false)->count();
        $pendingPayments  = $student->payments()->where('status', 'pending')->count();

        // Grade Point Average (UM scale: 1.00 = best, 5.00 = fail)
        $gradedCourses = $enrolledCourses->filter(fn($c) => $c->pivot->grade !== null);
        $gpa = $gradedCourses->count() > 0
            ? round($gradedCourses->avg('pivot.grade'), 2)
            : null;

        // Average attendance
        $avgAttendance = $enrolledCourses->count() > 0
            ? round($enrolledCourses->avg('pivot.attendance_percentage'), 1)
            : 100;

        return view('dashboard', compact(
            'student',
            'enrolledCourses',
            'totalUnits',
            'unreadMessages',
            'pendingPayments',
            'gpa',
            'avgAttendance',
        ));
    }
}