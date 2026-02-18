@extends('layouts.portal')

@section('title', 'Online Enrollment')

@section('content')
<div style="padding: 30px;">
    <!-- SECTION 1: Portal Header (SIS Integration & Onboarding) -->
    <div style="border-bottom: 2px solid #ddd; margin-bottom: 25px; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h2 style="color: var(--um-maroon); margin: 0; font-weight: 800; letter-spacing: -0.5px;">Online Enrollment</h2>
            <p style="color: #666; font-size: 0.9rem;">University of Mindanao • Academic Portal v2.0</p>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 0.8rem; color: #888; margin-bottom: 5px; font-weight: 600;">
                AY 2025-2026 | 1st Semester
            </div>
            <!-- Feature: SIS ID Integration Status -->
            <span style="font-size: 0.7rem; background: #e3f2fd; color: #1976d2; padding: 4px 12px; border-radius: 20px; border: 1px solid #bbdefb; font-weight: bold;">
                <i class="fas fa-fingerprint"></i> SIS VERIFIED: {{ Auth::user()->student_number }}
            </span>
        </div>
    </div>

    <!-- SECTION 2: Financial Arsenal (Real-time Ledger) -->
    <div style="background: #fff; border: 1px solid #e0e0e0; border-radius: 12px; padding: 20px; margin-bottom: 30px; display: flex; gap: 30px; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <div style="flex: 1; border-right: 1px solid #eee;">
            <span style="display: block; font-size: 0.7rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Outstanding Balance</span>
            <span style="font-size: 1.2rem; font-weight: 800; color: var(--um-maroon);">₱ 0.00</span>
        </div>
        <div style="flex: 1; border-right: 1px solid #eee;">
            <span style="display: block; font-size: 0.7rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Scholarship Tier</span>
            <span style="font-size: 1rem; font-weight: 700; color: #28a745;">Academic Grant (Full)</span>
        </div>
        <div style="flex: 1; display: flex; gap: 10px;">
            <button class="btn-login" style="flex: 1; padding: 10px; font-size: 0.75rem; background: #333; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <i class="fas fa-receipt"></i> VIEW LEDGER
            </button>
            <button class="btn-login" style="flex: 1; padding: 10px; font-size: 0.75rem; background: var(--um-maroon); display: flex; align-items: center; justify-content: center; gap: 8px;">
                <i class="fas fa-credit-card"></i> PAY TUITION
            </button>
        </div>
    </div>

    <!-- SECTION 3: System Communications -->
    @if(session('success'))
        <div class="alert" style="background: #d4edda; color: #155724; padding: 16px; border-radius: 8px; margin-bottom: 25px; border-left: 6px solid #28a745; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-check-circle fa-lg"></i>
                <div>
                    <strong style="display: block;">Onboarding Successful!</strong>
                    <span style="font-size: 0.85rem;">{{ session('success') }} Check your UM Outlook for the automated welcome sequence.</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert" style="background: #f8d7da; color: #721c24; padding: 16px; border-radius: 8px; margin-bottom: 25px; border-left: 6px solid #dc3545; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-times-circle fa-lg"></i>
                <div>
                    <strong style="display: block;">Action Blocked</strong>
                    <span style="font-size: 0.85rem;">{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    <!-- SECTION 4: Course Selection (Daily Task Tracking) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 25px;">
        @foreach($courses as $course)
        <div class="survey-card" style="padding: 0; overflow: hidden; border-radius: 12px; border: 1px solid #e0e0e0;">
            <!-- Status Header -->
            <div style="padding: 15px 20px; background: {{ $course->students_count >= $course->capacity ? '#f8f9fa' : '#fff5f5' }}; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 800; color: var(--um-maroon); font-size: 1.1rem;">{{ $course->course_code }}</span>
                @if($course->students_count >= $course->capacity)
                    <span style="font-size: 0.65rem; background: #6c757d; color: white; padding: 4px 10px; border-radius: 4px; font-weight: bold; letter-spacing: 0.5px;">CLOSED</span>
                @else
                    <span style="font-size: 0.65rem; background: #28a745; color: white; padding: 4px 10px; border-radius: 4px; font-weight: bold; letter-spacing: 0.5px;">OPEN</span>
                @endif
            </div>

            <div style="padding: 20px;">
                <p style="color: #444; font-size: 0.95rem; font-weight: 600; margin-bottom: 20px; min-height: 45px; line-height: 1.4;">{{ $course->course_name }}</p>
                
                <!-- Real-time Attendance Tracker -->
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.75rem; margin-bottom: 6px;">
                        <span style="color: #888; text-transform: uppercase;">Class Capacity</span>
                        <span style="font-weight: bold; color: #333;">{{ $course->students_count }} / {{ $course->capacity }}</span>
                    </div>
                    <div style="height: 6px; background: #eee; border-radius: 3px; overflow: hidden;">
                        <div style="width: {{ ($course->students_count / $course->capacity) * 100 }}%; height: 100%; background: {{ $course->students_count >= $course->capacity ? '#dc3545' : 'var(--um-maroon)' }}; transition: width 0.5s ease;"></div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px dashed #ddd;">
                    <!-- Academic Arsenal: Faculty Connection -->
                    <div style="color: #0056b3; font-size: 0.8rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px;" class="faculty-msg">
                        <i class="far fa-envelope"></i> Message Faculty
                    </div>

                    <form action="{{ route('enroll.store') }}" method="POST" class="enroll-form" data-course="{{ $course->course_code }}">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        
                        @if($course->students_count >= $course->capacity)
                            <button type="button" class="btn-login" style="background: #e9ecef; color: #adb5bd; cursor: not-allowed; border: 1px solid #dee2e6;" disabled>
                                LOCKED
                            </button>
                        @else
                            <button type="submit" class="btn-login" style="padding: 8px 18px; font-size: 0.8rem; box-shadow: 0 4px 0 var(--um-maroon-dark);">
                                ENROLL NOW
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .survey-card:hover { transform: translateY(-4px); box-shadow: 0 12px 20px rgba(0,0,0,0.08); border-color: var(--um-maroon); }
    .faculty-msg:hover { color: var(--um-maroon); text-decoration: underline; }
</style>
@endsection
