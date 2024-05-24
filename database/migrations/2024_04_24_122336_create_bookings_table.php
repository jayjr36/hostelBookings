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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('hostel_name');
            $table->string('home_address');
            $table->string('disability');
            $table->string('guardian_name');
            $table->string('guardian_contact');
            $table->string('relationship');
            $table->enum('duration', ['semester', 'year']);
            $table->integer('price');
            $table->integer('room_number');
            $table->string('payment_status')->default('not paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
