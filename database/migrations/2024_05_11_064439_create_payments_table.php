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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('patient_id')->nullable();
            $table->unsignedInteger('appointment_id')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            $table->string('patient_initial_deposit');
            $table->string('total_service_charge_amount');
            $table->string('patient_total_amount_to_be_charged');
            $table->string('patients_total_appointment_amount_deposits');
            $table->string('patient_remaining_amount');
            $table->string('total_payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
