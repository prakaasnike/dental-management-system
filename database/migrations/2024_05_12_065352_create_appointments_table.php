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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('doctor_id')->nullable();
            $table->unsignedInteger('patient_id')->nullable();
            $table->date('appointment_datetime');
            $table->enum('status', ["booked","cancelled","completed"]);
            $table->unsignedInteger('service_id')->nullable();
            $table->string('appointment_amount');
            $table->string('appointment_description');
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
