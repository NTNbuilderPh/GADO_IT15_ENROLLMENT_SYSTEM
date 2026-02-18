@extends('layouts.portal')

@section('title', 'Student Dashboard')

@section('content')
<div style="padding: 30px;">
    <!-- SECTION 1: Welcome & Onboarding Pulse -->
    <div style="margin-bottom: 30px;">
        <h2 style="color: var(--um-maroon); margin: 0; font-weight: 800;">Academic Dashboard</h2>
        <p style="color: #666; font-size: 0.95rem;">Welcome back, {{ Auth::user()->first_name }}! Your academic journey is synchronized.</p>
        
        <div style="margin-top: 15px; background: #fffde7; border: 1px solid #fff59d; padding: 12px 20px; border-radius: 8px; display: flex; align-items: center; gap: 15px;">
            <div style="background: #fbc02d; color: #fff; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div style="font-size: 0.85rem; color: #856404;">
                <strong>Onboarding Status:</strong> Your digital ID has been uploaded to the SIS. You are now cleared for 1st Semester 2025 enrollment.
            </div>
        </div>
    </div>

    <!-- SECTION 2: Academic Arsenal (Key Data Stats) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 35px;">
        <!-- Daily Task: Attendance Tracker -->
        <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #eee; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-size: 0.75rem; font-weight: bold; color: #888; text-transform: uppercase;">Real-time Attendance</span>
                <i class="fas fa-clock" style="color: #1976d2;"></i>
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #333;">94.2%</div>
            <div style="font-size: 0.75rem; color: #28a745; margin-top: 5px;">
                <i class="fas fa-caret-up"></i> 1.2% from last week
            </div>
        </div>

        <!-- Real-time Grade Tracking -->
        <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #eee; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-size: 0.75rem; font-weight: bold; color: #888; text-transform: uppercase;">GPA Estimate</span>
                <i class="fas fa-graduation-cap" style="color: var(--um-maroon);"></i>
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #333;">1.25</div>
            <div style="font-size: 0.75rem; color: #666; margin-top: 5px;">Based on current midterm marks</div>
        </div>

        <!-- Financial Ledger Quick-view -->
        <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #eee; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-size: 0.75rem; font-weight: bold; color: #888; text-transform: uppercase;">Wallet Balance</span>
                <i class="fas fa-wallet" style="color: #28a745;"></i>
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #333;">₱ 0.00</div>
            <div style="font-size: 0.75rem; color: #888; margin-top: 5px;">Scholarship coverage applied</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Left Column: Enrolled Courses & Daily Tasks -->
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; font-weight: 700;">My Enrolled Courses</h3>
                <a href="{{ route('enroll.index') }}" style="color: var(--um-maroon); font-size: 0.85rem; font-weight: bold; text-decoration: none;">
                    + Add Course
                </a>
            </div>

            @if(Auth::user()->courses->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach(Auth::user()->courses as $course)
                    <div style="background: white; border: 1px solid #eee; border-radius: 10px; padding: 15px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span style="display: block; font-weight: 800; color: var(--um-maroon); font-size: 0.9rem;">{{ $course->course_code }}</span>
                            <span style="color: #555; font-size: 0.85rem;">{{ $course->course_name }}</span>
                        </div>
                        <div style="text-align: right;">
                            <span style="display: block; font-size: 0.7rem; color: #999; text-transform: uppercase;">Schedule</span>
                            <span style="font-size: 0.8rem; font-weight: bold; color: #444;">MW 1:00 PM - 2:30 PM</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 50px; background: #fafafa; border: 2px dashed #eee; border-radius: 12px;">
                    <i class="fas fa-folder-open" style="font-size: 2rem; color: #ccc; margin-bottom: 10px; display: block;"></i>
                    <p style="color: #888; margin-bottom: 15px;">You haven't enrolled in any subjects yet.</p>
                    <a href="{{ route('enroll.index') }}" class="btn-login" style="text-decoration: none; padding: 10px 25px;">
                        GO TO ENROLLMENT
                    </a>
                </div>
            @endif
        </div>

        <!-- Right Column: Portal Communications -->
        <div>
            <h3 style="margin: 0 0 20px 0; font-weight: 700;">Faculty Messaging</h3>
            <div style="background: white; border: 1px solid #eee; border-radius: 12px; overflow: hidden;">
                <div style="padding: 15px; border-bottom: 1px solid #f5f5f5; display: flex; gap: 12px; align-items: center;">
                    <div style="width: 35px; height: 35px; background: #ddd; border-radius: 50%;"></div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="font-size: 0.8rem; font-weight: bold;">Dr. Maria Clara</span>
                            <span style="font-size: 0.65rem; color: #aaa;">2m ago</span>
                        </div>
                        <p style="margin: 3px 0 0 0; font-size: 0.75rem; color: #666; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            The quiz for IT15 has been moved...
                        </p>
                    </div>
                </div>
                <div style="padding: 15px; text-align: center;">
                    <button style="background: none; border: none; color: var(--um-maroon); font-size: 0.8rem; font-weight: bold; cursor: pointer;">
                        View All Messages
                    </button>
                </div>
            </div>

            <!-- Onboarding Reminder -->
            <div style="margin-top: 25px; background: var(--um-maroon); color: white; padding: 20px; border-radius: 12px; position: relative; overflow: hidden;">
                <h4 style="margin: 0 0 10px 0; font-size: 0.9rem;">Orientation Packet</h4>
                <p style="font-size: 0.75rem; opacity: 0.9; margin-bottom: 15px;">Download your "Frictionless Onboarding" guide to help navigate the Tagum Campus.</p>
                <button style="background: white; color: var(--um-maroon); border: none; padding: 6px 15px; border-radius: 4px; font-size: 0.7rem; font-weight: bold; cursor: pointer;">
                    DOWNLOAD PDF
                </button>
                <i class="fas fa-file-pdf" style="position: absolute; right: -10px; bottom: -10px; font-size: 4rem; opacity: 0.1;"></i>
            </div>
        </div>
    </div>
</div>
@endsection
