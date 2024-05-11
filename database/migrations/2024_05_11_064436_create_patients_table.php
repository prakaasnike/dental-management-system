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
            $table->string('patient_image')->nullable();
            $table->string('patient_before_image')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->enum('gender', ["male","female","other"]);
            $table->date('dob');
            $table->enum('blood_type', ["A+","A-","B+","B-","AB+","AB-","O+","O-"])->nullable();
            $table->string('address')->nullable();
            $table->date('registered_date');
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('appointment_id')->nullable();
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
