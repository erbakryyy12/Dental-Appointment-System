<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Appointments migration file
    public function up(): void
    {
        Schema::dropIfExists('appointments');
        
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointmentID');
            $table->unsignedBigInteger('userID')->nullable(); // Foreign Key
            $table->foreign('userID')->references('userID')->on('users');
            $table->unsignedBigInteger('dentistID')->nullable(); // Foreign Key
            $table->foreign('dentistID')->references('dentistID')->on('dentists');
            $table->date('appointmentDate');
            $table->json('appointmentTime'); // Changed to JSON data type
            $table->string('medicalPrescription'); 
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
