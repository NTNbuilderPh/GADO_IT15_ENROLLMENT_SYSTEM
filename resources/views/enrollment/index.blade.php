@extends('layouts.app')
@section('title', 'Course Enrollment')

@section('content')
<div class="page-header">
    <h1>📝 Course Enrollment</h1>
    <p class="text-muted">1st Semester, A.Y. 2024–2025 | Currently enrolled in {{ count($enrolledIds) }} course(s)</p>
</div>

<div class="courses-grid">
    @foreach($courses as $course)
    <div class="course-card {{ in_array($course->id, $enrolledIds) ? 'enrolled' : '' }} {{ $course->isFull() ? 'full' : '' }}"
         data-capacity="{{ $course->capacity }}"
         data-count="{{ $course->students_count }}">

        <div class="course-header">
            <span class="course-code">{{ $course->course_code }}</span>
            <span class="course-units">{{ $course->units }} units</span>
        </div>

        <h3 class="course-name">{{ $course->course_name }}</h3>

        <p class="course-desc">{{ Str::limit($course->description, 100) }}</p>

        <div class="course-meta">
            <div><strong>📅</strong> {{ $course->schedule }}</div>
            <div><strong>👨‍🏫</strong> {{ $course->instructor }}</div>
            <div><strong>🏫</strong> Room {{ $course->room }}</div>
        </div>

        {{-- Capacity Indicator --}}
        <div class="capacity-bar">
            <div class="capacity-fill"
                 style="width: {{ $course->capacity_percentage }}%"
                 data-percentage="{{ $course->capacity_percentage }}">
            </div>
            <span class="capacity-text">
                {{ $course->students_count }}/{{ $course->capacity }} slots
                @if($course->isFull())
                    — <strong class="text-danger">FULL</strong>
                @else
                    — <strong class="text-success">{{ $course->available_slots }} left</strong>
                @endif
            </span>
        </div>

        {{-- Action Buttons --}}
        <div class="course-actions">
            @if(in_array($course->id, $enrolledIds))
                <span class="badge badge-success">✅ Enrolled</span>
                <form method="POST" action="{{ route('enrollment.drop') }}" class="inline-form"
                      onsubmit="return confirm('Drop {{ $course->course_code }}? This action is recorded.')">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" class="btn btn-sm btn-danger">Drop</button>
                </form>
            @elseif($course->isFull())
                <button class="btn btn-sm btn-disabled" disabled>Section Full</button>
            @else
                <form method="POST" action="{{ route('enrollment.enroll') }}" class="inline-form enroll-form">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" class="btn btn-sm btn-primary">Enroll</button>
                </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection