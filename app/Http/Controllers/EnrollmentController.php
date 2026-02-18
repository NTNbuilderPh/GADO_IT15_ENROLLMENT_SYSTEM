<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $course = Course::findOrFail($request->course_id);

        // Check 1: Prevent Duplicate Enrollments
        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Student is already enrolled in this course.');
        }

        // Check 2: Respect Course Capacity
        if ($course->students()->count() >= $course->capacity) {
            return back()->with('error', 'Enrollment failed: Course capacity reached.');
        }

        // Attach relationship
        $student->courses()->attach($course->id);

        return back()->with('success', 'Successfully enrolled in ' . $course->course_name);
    }
}