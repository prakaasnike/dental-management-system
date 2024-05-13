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
            $table->enum('blood_type', ["A+","A-","B+","B-","AB+","AB-","O+","O-","None"])->nullable();
            $table->string('address')->nullable();
            $table->date('registered_date');
            $table->unsignedInteger('treatment_id')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            $table->string('medical_issues')->nullable();
            $table->decimal('initial_amount', 10, 2);
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
