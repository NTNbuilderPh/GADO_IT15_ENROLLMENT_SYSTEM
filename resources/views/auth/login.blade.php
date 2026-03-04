@extends('layouts.app')
@section('title', 'SIS Login')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="um-logo-large">UM</div>
            <h1>University of Mindanao</h1>
            <p class="subtitle">Student Information System — Academic Portal</p>
        </div>

        <form method="POST" action="{{ route('login.submit') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="credential">Student ID or Email</label>
                <input type="text"
                       id="credential"
                       name="credential"
                       value="{{ old('credential') }}"
                       placeholder="UM-2024-0001 or email@umindanao.edu.ph"
                       required
                       autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Enter your password"
                       required>
            </div>

            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-full">Sign In to Portal</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</div>
@endsection