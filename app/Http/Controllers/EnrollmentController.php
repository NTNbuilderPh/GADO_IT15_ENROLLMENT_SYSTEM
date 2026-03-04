<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Display available courses with capacity status.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $courses = Course::where('is_active', true)
                         ->orderBy('course_code')
                         ->get();

        // IDs the student is already enrolled in
        $enrolledIds = $student->enrolledCourses()->pluck('courses.id')->toArray();

        return view('enrollment.index', compact('courses', 'student', 'enrolledIds'));
    }

    /**
     * ENROLL: Execute with business rules.
     *
     * Rules enforced:
     *   1. Capacity Control  — students_count < capacity
     *   2. Duplicate Prevention — unique pivot check
     */
    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student  = Auth::guard('student')->user();
        $courseId  = $request->input('course_id');

        // Use a DB transaction for atomicity
        return DB::transaction(function () use ($student, $courseId) {

            // Lock the row to prevent race conditions
            $course = Course::lockForUpdate()->findOrFail($courseId);

            // RULE 1 — Duplicate Prevention
            if ($student->isEnrolledIn($courseId)) {
                return back()->with('error', "You are already enrolled in {$course->course_code}.");
            }

            // RULE 2 — Capacity Control
            if ($course->isFull()) {
                return back()->with('error', "{$course->course_code} is already at full capacity ({$course->capacity}/{$course->capacity}).");
            }

            // Execute enrollment
            $student->courses()->attach($courseId, [
                'status'                => 'enrolled',
                'enrolled_at'           => now(),
                'attendance_percentage' => 100.00,
            ]);

            // Increment denormalized counter
            $course->increment('students_count');

            return back()->with('success', "Successfully enrolled in {$course->course_code}: {$course->course_name}!");
        });
    }

    /**
     * DROP: Remove enrollment.
     */
    public function drop(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student  = Auth::guard('student')->user();
        $courseId  = $request->input('course_id');

        return DB::transaction(function () use ($student, $courseId) {

            $course = Course::lockForUpdate()->findOrFail($courseId);

            if (!$student->isEnrolledIn($courseId)) {
                return back()->with('error', 'You are not enrolled in this course.');
            }

            // Update pivot status instead of hard delete (audit trail)
            $student->courses()->updateExistingPivot($courseId, [
                'status' => 'dropped',
            ]);

            // Decrement counter
            $course->decrement('students_count');

            return back()->with('success', "Dropped {$course->course_code} successfully.");
        });
    }
}