<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['cash', 'gcash', 'bank_transfer', 'credit_card'])->default('cash');
            $table->string('reference_number', 100)->unique()->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('description', 255)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['student_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
