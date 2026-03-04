@extends('layouts.app')
@section('title', 'Student Registration')

@section('content')
<div class="auth-container">
    <div class="auth-card auth-card-wide">
        <div class="auth-header">
            <div class="um-logo-large">UM</div>
            <h1>Student Registration</h1>
            <p class="subtitle">Create your Academic Portal account</p>
        </div>

        <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" class="auth-form">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="student_number">Student Number *</label>
                    <input type="text" id="student_number" name="student_number"
                           value="{{ old('student_number') }}" placeholder="UM-2024-XXXX" required>
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}" placeholder="name@umindanao.edu.ph" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name *</label>
                    <input type="text" id="first_name" name="first_name"
                           value="{{ old('first_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name *</label>
                    <input type="text" id="last_name" name="last_name"
                           value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="program">Program *</label>
                    <select id="program" name="program" required>
                        <option value="">Select Program</option>
                        <option value="BS Information Technology" {{ old('program') == 'BS Information Technology' ? 'selected' : '' }}>BS Information Technology</option>
                        <option value="BS Computer Science" {{ old('program') == 'BS Computer Science' ? 'selected' : '' }}>BS Computer Science</option>
                        <option value="BS Information Systems" {{ old('program') == 'BS Information Systems' ? 'selected' : '' }}>BS Information Systems</option>
                        <option value="BS Computer Engineering" {{ old('program') == 'BS Computer Engineering' ? 'selected' : '' }}>BS Computer Engineering</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year_level">Year Level *</label>
                    <select id="year_level" name="year_level" required>
                        <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                        <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required minlength="8">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label for="id_photo">Digital ID Photo</label>
                <input type="file" id="id_photo" name="id_photo" accept="image/jpeg,image/png">
                <small class="form-hint">Upload your school ID (JPG/PNG, max 2MB)</small>
            </div>

            <button type="submit" class="btn btn-primary btn-full">Create Account</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </div>
</div>
@endsection