<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | UM Student Portal</title>
    
    <!-- UM Maroon Branding & Sidebar Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Icons for Academic Portal Arsenal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Sidebar Grouping Styles (UM Brand) */
        .nav-group-title {
            padding: 15px 20px 5px 20px;
            font-size: 11px;
            text-transform: uppercase;
            color: #888;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .sidebar-user {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--um-maroon);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Financial Ledger Quick View */
        .ledger-sidebar-badge {
            margin: 10px 20px;
            padding: 10px;
            background: #fff;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="portal-container">
        <!-- Sidebar: The Command Center -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-university"></i> studentportal
            </div>

            <div class="sidebar-user">
                <div class="user-avatar">{{ substr(Auth::user()->first_name, 0, 1) }}</div>
                <div>
                    <div style="font-size: 13px; font-weight: bold; color: #333;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                    <div style="font-size: 11px; color: #888;">ID: {{ Auth::user()->student_number }}</div>
                </div>
            </div>

            <nav>
                <div class="nav-group-title">Main</div>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                
                <div class="nav-group-title">Enrollment Design</div>
                <a href="{{ route('enroll.index') }}" class="nav-link">
                    <i class="fas fa-edit"></i> Enroll Course
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-alt"></i> Class Schedule
                </a>

                <div class="nav-group-title">Academic Arsenal</div>
                <a href="#" class="nav-link">
                    <i class="fas fa-file-invoice"></i> Real-time Grades
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-clock"></i> Attendance Tracker
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-comments"></i> Faculty Messaging
                </a>

                <div class="nav-group-title">Financials</div>
                <div class="ledger-sidebar-badge">
                    <div style="color: #888; margin-bottom: 2px;">Current Balance</div>
                    <div style="color: var(--um-maroon); font-weight: bold;">₱ 0.00</div>
                </div>
            </nav>

            <div style="position: absolute; bottom: 0; width: var(--sidebar-width); border-top: 1px solid #ddd;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer; color: #dc3545;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="main-content">
            <!-- Top Navbar (Onboarding Status) -->
            <header style="background: #fff; padding: 15px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: flex-end; align-items: center;">
                <div style="font-size: 12px; color: #666;">
                    <i class="fas fa-check-circle" style="color: #28a745;"></i> 
                    Onboarding Complete: Welcome to UM Tagum Campus
                </div>
            </header>

            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>