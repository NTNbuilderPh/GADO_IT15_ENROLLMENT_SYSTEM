
              GADO_IT15_ENROLLMENT_SYSTEM
University of Mindanao - Academic Portal Project

This project is a high-fidelity enrollment and academic management portal built for the IT15 (Web Systems and Technologies) course at the University of Mindanao.

---------------------------------------------------------
🚀 THE "ACADEMIC ARSENAL" FEATURES
---------------------------------------------------------
We have implemented a dual-focus system that balances smooth entry (Onboarding) with long-term student success (Portal Management).

[Feature Set]          [Goal]                       [Implementation Details]
Enrollment Design      Frictionless Onboarding      Digital ID upload & SIS integration via student_number verification.
Academic Portal        Daily Task Management        Real-time tracking for grades and attendance percentages.
Communication          Unified Messaging            Automated "Welcome" email sequences and direct faculty messaging.
Financials             Secure Ledger                Secure tuition payment gateway and scholarship balance ledger.

---------------------------------------------------------
🏗 SYSTEM ARCHITECTURE & LOGIC
---------------------------------------------------------
1. Enrollment Business Rules
- Capacity Control: Every course has a defined capacity. If students_count >= capacity, the system blocks the enrollment request.
- Duplicate Prevention: The backend checks the course_student pivot table to ensure a student cannot enroll in the same subject twice.
- SIS Integration: The Login system uses a unified authentication logic where students can use their Student ID or Email to access the portal.

2. Database Schema (Many-to-Many)
- Students Table: Stores profiles and unique identifiers.
- Courses Table: Stores academic subjects and enrollment limits.
- course_student Table: The pivot table connecting students to their chosen subjects.

---------------------------------------------------------
🛠 TECHNICAL SETUP
---------------------------------------------------------
Root Directory: Place all Laravel folders here.
Environment:
- Copy .env.example to .env
- Run php artisan key:generate

Database:
- Run php artisan migrate to build the tables.
- Run php artisan db:seed --class=UMPortalSeeder to populate UM data.

Assets:
- CSS: public/css/app.css (UM Maroon Branding)
- JS: public/js/app.js (Capacity validation logic)

---------------------------------------------------------
📂 SUBMISSION FILES
---------------------------------------------------------
/app (Models & Controllers)
/database (Migrations & Seeders)
/resources/views (Blade Templates: Dashboard, Enroll, Login, Portal)
/public (CSS, JS, and UM Logos)
/routes (web.php)
README.md (This documentation)

Note: vendor/ and node_modules/ have been excluded to maintain a lightweight submission size.

Course: IT15 - Web Systems and Technologies
Institution: University of Mindanao (Tagum Campus)

