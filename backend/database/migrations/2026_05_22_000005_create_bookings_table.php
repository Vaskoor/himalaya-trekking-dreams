<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('trek_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->date('start_date');
            $table->integer('number_of_people');
            $table->decimal('total_amount', 10, 2);
            $table->text('special_requests')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
