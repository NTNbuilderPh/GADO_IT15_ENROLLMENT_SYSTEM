<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 20)->unique();
            $table->string('course_name', 200);
            $table->text('description')->nullable();
            $table->integer('units')->default(3);
            $table->string('schedule', 150)->nullable();
            $table->string('instructor', 150)->nullable();
            $table->integer('capacity')->default(40);
            $table->integer('students_count')->default(0);   // Denormalized counter
            $table->string('semester', 50)->default('1st Semester');
            $table->string('academic_year', 20)->default('2024-2025');
            $table->string('room', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};