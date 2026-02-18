# 🎓 GADO_IT15_ENROLLMENT_SYSTEM

## University of Mindanao – Academic Portal Project

A high-fidelity Enrollment and Academic Management Portal developed for **IT15 – Web Systems and Technologies** at the University of Mindanao (Tagum Campus).

This system demonstrates practical implementation of Laravel’s MVC architecture, Eloquent ORM relationships, authentication logic, validation rules, and structured frontend design.

---

## 🚀 Academic Arsenal Features

This project follows a **dual-focus system design**:

* **Frictionless Onboarding** (Enrollment Efficiency)
* **Long-Term Academic Management** (Student Success Portal)

### 🔹 Core Features

#### 1️⃣ Enrollment Design – *Frictionless Onboarding*

* Digital ID upload system
* Student Information System (SIS) integration
* Student verification via `student_number`
* Automated enrollment validation

#### 2️⃣ Academic Portal – *Daily Task Management*

* Real-time grade tracking
* Attendance percentage monitoring
* Student dashboard overview
* Structured academic summaries

#### 3️⃣ Communication – *Unified Messaging*

* Automated "Welcome" email sequence
* Direct faculty-to-student messaging support
* Portal-based announcements

#### 4️⃣ Financials – *Secure Ledger System*

* Secure tuition payment gateway integration (simulation-ready)
* Scholarship balance ledger tracking
* Transparent financial summary display

---

# 🏗 System Architecture & Business Logic

## 1️⃣ Enrollment Business Rules

### ✅ Capacity Control

Each course has a defined enrollment capacity.

```php
if ($students_count >= $capacity) {
    // Enrollment request blocked
}
```

If the maximum number of students is reached, enrollment is automatically denied.

---

### ✅ Duplicate Prevention

The system checks the `course_student` pivot table to prevent duplicate enrollments.

```php
$exists = $student->courses()->where('course_id', $course->id)->exists();
```

Students cannot enroll in the same course twice.

---

### ✅ SIS Authentication Logic

Unified login system:

* Students may log in using:

  * Student ID
  * Email Address

This ensures flexible and modern authentication behavior.

---

# 🗄 Database Design (Many-to-Many Relationship)

### 📌 Students Table

* Stores student profiles
* Unique `student_number`
* Authentication credentials

### 📌 Courses Table

* Course code
* Course title
* Defined capacity limit

### 📌 course_student (Pivot Table)

* `student_id`
* `course_id`
* Manages many-to-many relationship

---

# 🛠 Technical Setup

## 📂 Root Directory

Place all Laravel project folders inside the root directory.

---

## ⚙️ Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Configure database credentials inside `.env`.

---

## 🗃 Database Setup

```bash
php artisan migrate
php artisan db:seed --class=UMPortalSeeder
```

This will:

* Create necessary tables
* Populate initial University of Mindanao data

---

## 🎨 Frontend Assets

| Asset Type | Location             | Description                             |
| ---------- | -------------------- | --------------------------------------- |
| CSS        | `public/css/app.css` | University of Mindanao Maroon Branding  |
| JS         | `public/js/app.js`   | Capacity validation & interactive logic |

---

# 📂 Project Structure

```
app/
 ├── Models/
 └── Controllers/

database/
 ├── migrations/
 └── seeders/

resources/views/
 ├── dashboard.blade.php
 ├── enroll.blade.php
 ├── login.blade.php
 └── portal.blade.php

public/
 ├── css/
 ├── js/
 └── images/

routes/
 └── web.php

README.md
```

---

# 📦 Submission Notes

To maintain a lightweight repository size:

* `vendor/` has been excluded
* `node_modules/` has been excluded

These directories can be restored via:

```bash
composer install
npm install
```

---

# 🎓 Academic Information

**Course:** IT15 – Web Systems and Technologies
**Institution:** University of Mindanao (Tagum Campus)
**Framework:** Laravel 12
**PHP Version:** ^8.2

---

# 📄 License

This project is developed strictly for academic purposes under the University of Mindanao.

© 2026 University of Mindanao



