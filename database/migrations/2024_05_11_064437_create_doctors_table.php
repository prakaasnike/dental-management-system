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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('specialization_id')->nullable();
            $table->string('doctor_image')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->enum('gender', ["male","female","other"]);
            $table->date('dob');
            $table->integer('years_of_experience');
            $table->string('address');
            $table->unsignedInteger('appointment_id')->nullable();
            $table->foreignId('patient_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
