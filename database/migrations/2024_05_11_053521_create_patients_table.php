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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_image');
            $table->string('patient_before_image');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->enum('gender', ["male","female","other"]);
            $table->date('dob');
            $table->enum('blood_type', ["A+","A-","B+","B-","AB+","AB-","O+","O-"]);
            $table->string('address');
            $table->date('registered_date');
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('appointment_id')->nullable();
            $table->unsignedInteger('labreport_id')->nullable();
            $table->foreignId('doctor_id');
            $table->foreignId('lab_report_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
