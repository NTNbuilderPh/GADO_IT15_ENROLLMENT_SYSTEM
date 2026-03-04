<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Course;
use Carbon\Carbon;

class UMPortalSeeder extends Seeder
{
    /**
     * Populate UM Tagum Campus data.
     */
    public function run(): void
    {
        $this->command->info('🎓 Seeding University of Mindanao Portal Data...');

        // ──────────────────────────────────────────────
        //  STUDENTS
        // ──────────────────────────────────────────────
        $students = [
            [
                'student_number'      => 'UM-2024-0001',
                'first_name'          => 'Juan',
                'last_name'           => 'Dela Cruz',
                'email'               => 'juan.delacruz@umindanao.edu.ph',
                'password'            => Hash::make('password123'),
                'phone'               => '09171234567',
                'address'             => 'Tagum City, Davao del Norte',
                'date_of_birth'       => '2003-05-15',
                'gender'              => 'Male',
                'program'             => 'BS Information Technology',
                'year_level'          => '2nd Year',
                'tuition_balance'     => 28500.00,
                'scholarship_balance' => 5000.00,
            ],
            [
                'student_number'      => 'UM-2024-0002',
                'first_name'          => 'Maria',
                'last_name'           => 'Santos',
                'email'               => 'maria.santos@umindanao.edu.ph',
                'password'            => Hash::make('password123'),
                'phone'               => '09181234567',
                'address'             => 'Carmen, Davao del Norte',
                'date_of_birth'       => '2002-11-22',
                'gender'              => 'Female',
                'program'             => 'BS Information Technology',
                'year_level'          => '3rd Year',
                'tuition_balance'     => 15000.00,
                'scholarship_balance' => 10000.00,
            ],
            [
                'student_number'      => 'UM-2024-0003',
                'first_name'          => 'Pedro',
                'last_name'           => 'Reyes',
                'email'               => 'pedro.reyes@umindanao.edu.ph',
                'password'            => Hash::make('password123'),
                'phone'               => '09191234567',
                'address'             => 'Panabo City, Davao del Norte',
                'date_of_birth'       => '2003-08-10',
                'gender'              => 'Male',
                'program'             => 'BS Computer Science',
                'year_level'          => '1st Year',
                'tuition_balance'     => 32000.00,
                'scholarship_balance' => 0.00,
            ],
            [
                'student_number'      => 'UM-2024-0004',
                'first_name'          => 'Ana',
                'last_name'           => 'Garcia',
                'email'               => 'ana.garcia@umindanao.edu.ph',
                'password'            => Hash::make('password123'),
                'phone'               => '09201234567',
                'address'             => 'Tagum City, Davao del Norte',
                'date_of_birth'       => '2002-03-28',
                'gender'              => 'Female',
                'program'             => 'BS Information Technology',
                'year_level'          => '4th Year',
                'tuition_balance'     => 8500.00,
                'scholarship_balance' => 15000.00,
            ],
            [
                'student_number'      => 'UM-2024-0005',
                'first_name'          => 'Carlo',
                'last_name'           => 'Gado',
                'email'               => 'carlo.gado@umindanao.edu.ph',
                'password'            => Hash::make('password123'),
                'phone'               => '09211234567',
                'address'             => 'Tagum City, Davao del Norte',
                'date_of_birth'       => '2003-01-12',
                'gender'              => 'Male',
                'program'             => 'BS Information Technology',
                'year_level'          => '2nd Year',
                'tuition_balance'     => 22000.00,
                'scholarship_balance' => 3000.00,
            ],
        ];

        foreach ($students as $data) {
            Student::updateOrCreate(
                ['student_number' => $data['student_number']],
                $data
            );
        }

        $this->command->info('   ✅ ' . count($students) . ' students seeded.');

        // ──────────────────────────────────────────────
        //  COURSES  (IT15 curriculum subjects)
        // ──────────────────────────────────────────────
        $courses = [
            [
                'course_code'   => 'IT15',
                'course_name'   => 'Web Systems and Technologies',
                'description'   => 'Fundamentals of web development including HTML, CSS, JavaScript, PHP and Laravel framework.',
                'units'         => 3,
                'schedule'      => 'MWF 10:00–11:30 AM',
                'instructor'    => 'Prof. Mark Anthony Sabandal',
                'capacity'      => 40,
                'room'          => 'CL-3',
            ],
            [
                'course_code'   => 'IT14',
                'course_name'   => 'Database Management Systems',
                'description'   => 'Design and implementation of relational databases using MySQL and query optimization.',
                'units'         => 3,
                'schedule'      => 'TTh 1:00–2:30 PM',
                'instructor'    => 'Prof. Jennifer Abad',
                'capacity'      => 35,
                'room'          => 'CL-2',
            ],
            [
                'course_code'   => 'IT16',
                'course_name'   => 'Information Assurance and Security',
                'description'   => 'Principles of cybersecurity, encryption, and secure software development.',
                'units'         => 3,
                'schedule'      => 'MWF 1:00–2:30 PM',
                'instructor'    => 'Prof. Ryan Torres',
                'capacity'      => 30,
                'room'          => 'CL-4',
            ],
            [
                'course_code'   => 'IT17',
                'course_name'   => 'Networking Fundamentals',
                'description'   => 'TCP/IP, subnetting, routing protocols, and network administration.',
                'units'         => 3,
                'schedule'      => 'TTh 8:00–9:30 AM',
                'instructor'    => 'Prof. Dennis Mendoza',
                'capacity'      => 35,
                'room'          => 'NL-1',
            ],
            [
                'course_code'   => 'IT18',
                'course_name'   => 'Systems Integration and Architecture',
                'description'   => 'Enterprise architecture, API design, microservices, and system integration patterns.',
                'units'         => 3,
                'schedule'      => 'MWF 8:00–9:30 AM',
                'instructor'    => 'Prof. Carla Villanueva',
                'capacity'      => 30,
                'room'          => 'CL-5',
            ],
            [
                'course_code'   => 'GE05',
                'course_name'   => 'Purposive Communication',
                'description'   => 'Academic and professional communication in multicultural contexts.',
                'units'         => 3,
                'schedule'      => 'TTh 10:00–11:30 AM',
                'instructor'    => 'Prof. Elena Ramos',
                'capacity'      => 45,
                'room'          => 'LH-2',
            ],
            [
                'course_code'   => 'GE03',
                'course_name'   => 'The Contemporary World',
                'description'   => 'Globalization, cultural dynamics, and contemporary societal issues.',
                'units'         => 3,
                'schedule'      => 'MWF 3:00–4:30 PM',
                'instructor'    => 'Prof. Roberto Cruz',
                'capacity'      => 50,
                'room'          => 'LH-1',
            ],
            [
                'course_code'   => 'IT-ELECT1',
                'course_name'   => 'Mobile Application Development',
                'description'   => 'Cross-platform mobile development using Flutter and React Native.',
                'units'         => 3,
                'schedule'      => 'Sat 8:00–11:00 AM',
                'instructor'    => 'Prof. Kevin Lim',
                'capacity'      => 25,
                'room'          => 'CL-6',
            ],
        ];

        foreach ($courses as $data) {
            Course::updateOrCreate(
                ['course_code' => $data['course_code']],
                array_merge($data, [
                    'semester'      => '1st Semester',
                    'academic_year' => '2024-2025',
                ])
            );
        }

        $this->command->info('   ✅ ' . count($courses) . ' courses seeded.');

        // ──────────────────────────────────────────────
        //  SAMPLE ENROLLMENTS (pivot)
        // ──────────────────────────────────────────────
        $juan  = Student::where('student_number', 'UM-2024-0001')->first();
        $maria = Student::where('student_number', 'UM-2024-0002')->first();
        $carlo = Student::where('student_number', 'UM-2024-0005')->first();

        $it15 = Course::where('course_code', 'IT15')->first();
        $it14 = Course::where('course_code', 'IT14')->first();
        $ge05 = Course::where('course_code', 'GE05')->first();

        if ($juan && $it15) {
            $juan->courses()->syncWithoutDetaching([
                $it15->id => [
                    'grade'                 => 1.50,
                    'attendance_percentage' => 92.50,
                    'status'                => 'enrolled',
                    'enrolled_at'           => Carbon::now(),
                ],
                $it14->id => [
                    'grade'                 => 1.75,
                    'attendance_percentage' => 88.00,
                    'status'                => 'enrolled',
                    'enrolled_at'           => Carbon::now(),
                ],
            ]);
            $it15->increment('students_count');
            $it14->increment('students_count');
        }

        if ($maria && $it15) {
            $maria->courses()->syncWithoutDetaching([
                $it15->id => [
                    'grade'                 => 1.25,
                    'attendance_percentage' => 96.00,
                    'status'                => 'enrolled',
                    'enrolled_at'           => Carbon::now(),
                ],
                $ge05->id => [
                    'grade'                 => 1.00,
                    'attendance_percentage' => 100.00,
                    'status'                => 'enrolled',
                    'enrolled_at'           => Carbon::now(),
                ],
            ]);
            $it15->increment('students_count');
            $ge05->increment('students_count');
        }

        if ($carlo && $it15) {
            $carlo->courses()->syncWithoutDetaching([
                $it15->id => [
                    'grade'                 => null,
                    'attendance_percentage' => 85.00,
                    'status'                => 'enrolled',
                    'enrolled_at'           => Carbon::now(),
                ],
            ]);
            $it15->increment('students_count');
        }

        $this->command->info('   ✅ Sample enrollments created.');
        $this->command->info('');
        $this->command->info('🏫 University of Mindanao Portal — Ready!');
        $this->command->info('   Login credentials: password123');
    }
}