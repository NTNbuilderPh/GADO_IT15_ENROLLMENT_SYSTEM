<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number', 20)->unique();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('program', 150)->nullable();
            $table->enum('year_level', ['1st Year', '2nd Year', '3rd Year', '4th Year'])->default('1st Year');
            $table->string('id_photo')->nullable();           // Digital ID upload path
            $table->decimal('scholarship_balance', 12, 2)->default(0.00);
            $table->decimal('tuition_balance', 12, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();

            // Index for SIS login lookup
            $table->index(['student_number', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};