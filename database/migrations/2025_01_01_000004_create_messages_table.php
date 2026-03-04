<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade');
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');
            $table->timestamp('enrolled_at')->useCurrent();
            $table->decimal('grade', 3, 2)->nullable();                // e.g. 1.00 – 5.00
            $table->decimal('attendance_percentage', 5, 2)->default(100.00);
            $table->enum('status', ['enrolled', 'dropped', 'completed', 'failed'])->default('enrolled');
            $table->text('remarks')->nullable();
            $table->timestamps();

            // DUPLICATE PREVENTION — one student, one course, one record
            $table->unique(['course_id', 'student_id'], 'unique_enrollment');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_student');
    }
};
