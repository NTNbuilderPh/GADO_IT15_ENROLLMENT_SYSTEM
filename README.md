============================================================
               GADO_IT15_ENROLLMENT_SYSTEM
============================================================

        University of Mindanao - Academic Portal Project

This project is a high-fidelity Enrollment and Academic 
Management Portal developed for:

Course: IT15 – Web Systems and Technologies
Institution: University of Mindanao (Tagum Campus)

============================================================
🚀 THE "ACADEMIC ARSENAL" FEATURES
============================================================

The system is designed with a dual-focus approach:

1. Smooth Entry (Onboarding Experience)
2. Long-Term Student Success (Portal Management)

------------------------------------------------------------
FEATURE SET OVERVIEW
------------------------------------------------------------

[1] ENROLLMENT DESIGN
Goal: Frictionless Onboarding
• Digital ID upload
• SIS integration via student_number verification
• Structured student validation workflow

[2] ACADEMIC PORTAL
Goal: Daily Task Management
• Real-time grade tracking
• Attendance percentage monitoring
• Centralized academic dashboard

[3] COMMUNICATION
Goal: Unified Messaging
• Automated “Welcome” email sequences
• Direct faculty-to-student messaging
• Integrated notification system

[4] FINANCIALS
Goal: Secure Ledger Management
• Secure tuition payment gateway
• Scholarship balance ledger tracking
• Transparent financial records

============================================================
🏗 SYSTEM ARCHITECTURE & LOGIC
============================================================

------------------------------------------------------------
1. ENROLLMENT BUSINESS RULES
------------------------------------------------------------

CAPACITY CONTROL
• Each course has a defined capacity.
• If students_count >= capacity
  → Enrollment request is automatically blocked.

DUPLICATE PREVENTION
• Backend validates via course_student pivot table.
• Prevents a student from enrolling in the same subject twice.

SIS INTEGRATION
• Unified authentication logic.
• Students may log in using:
  - Student ID
  - Registered Email Address

------------------------------------------------------------
2. DATABASE SCHEMA (Many-to-Many Relationship)
------------------------------------------------------------

STUDENTS TABLE
• Stores student profiles
• Contains unique identifiers

COURSES TABLE
• Stores academic subjects
• Defines enrollment capacity limits

COURSE_STUDENT TABLE (Pivot)
• Connects students to enrolled subjects
• Manages many-to-many relationships

============================================================
🛠 TECHNICAL SETUP
============================================================

ROOT DIRECTORY
• Place all Laravel project folders here.

------------------------------------------------------------
ENVIRONMENT CONFIGURATION
------------------------------------------------------------

1. Copy environment file:
   cp .env.example .env

2. Generate application key:
   php artisan key:generate

------------------------------------------------------------
DATABASE SETUP
------------------------------------------------------------

1. Run migrations:
   php artisan migrate

2. Seed UM sample data:
   php artisan db:seed --class=UMPortalSeeder

------------------------------------------------------------
ASSETS STRUCTURE
------------------------------------------------------------

CSS:
• public/css/app.css
  - Implements UM Maroon Branding

JavaScript:
• public/js/app.js
  - Handles capacity validation logic
  - Frontend dynamic behaviors

============================================================
📂 SUBMISSION FILE STRUCTURE
============================================================

/app
  → Models & Controllers

/database
  → Migrations & Seeders

/resources/views
  → Blade Templates:
     - Dashboard
     - Enroll
     - Login
     - Portal

/public
  → CSS, JS, and UM Logos

/routes
  → web.php

README.md
  → Project Documentation

------------------------------------------------------------

NOTE:
vendor/ and node_modules/ folders are excluded 
to maintain a lightweight ZIP submission size.

============================================================
END OF DOCUMENT
============================================================

