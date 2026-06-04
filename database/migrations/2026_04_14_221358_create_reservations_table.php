<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['consultation', 'follow_up', 'analysis']);
            $table->decimal('price', 7, 2)->nullable();
            $table->timestamp('paid_at')->nullable()->after('transaction_id');
            $table->string('transaction_id')->nullable()->after('payment_method');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_status')->default('unpaid')->after('price');
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->string('notes')->nullable();
            $table->string('descriptions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
