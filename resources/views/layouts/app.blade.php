<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'UM Academic Portal') — University of Mindanao</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    {{-- ─── Navigation ─── --}}
    @auth('student')
    <nav class="um-nav">
        <div class="nav-brand">
            <div class="nav-logo">UM</div>
            <span>Academic Portal</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('enrollment.index') }}" class="{{ request()->routeIs('enrollment.*') ? 'active' : '' }}">Enrollment</a>
            <a href="{{ route('portal.grades') }}" class="{{ request()->routeIs('portal.grades') ? 'active' : '' }}">Grades</a>
            <a href="{{ route('portal.attendance') }}" class="{{ request()->routeIs('portal.attendance') ? 'active' : '' }}">Attendance</a>
            <a href="{{ route('messages.index') }}" class="{{ request()->routeIs('messages.*') ? 'active' : '' }}">Messages</a>
            <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">Payments</a>
        </div>
        <div class="nav-user">
            <span class="user-name">{{ Auth::guard('student')->user()->full_name }}</span>
            <span class="user-id">{{ Auth::guard('student')->user()->student_number }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline">Logout</button>
            </form>
        </div>
    </nav>
    @endauth

    {{-- ─── Flash Messages ─── --}}
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>⚠️ {{ $error }}</div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ─── Main Content ─── --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- ─── Footer ─── --}}
    <footer class="um-footer">
        <p>&copy; {{ date('Y') }} University of Mindanao — Tagum Campus | IT15 Web Systems and Technologies</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>