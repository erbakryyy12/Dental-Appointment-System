<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Dentists migration file
    public function up(): void
    {
        Schema::create('dentists', function (Blueprint $table) {
            $table->id('dentistID');
            $table->unsignedBigInteger('userID')->nullable(); // Foreign Key
            $table->foreign('userID')->references('userID')->on('users');
            $table->string('dentistSpeciality');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
