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
            $table->string('total_treatment_charge_amount')->nullable();
            $table->string('total_service_charge_amount')->nullable();
            $table->string('total_appointment_amount_deposits')->nullable();
            $table->string('patient_remaining_amount');
            $table->string('total_payments');
            $table->enum('status', ["paid","unpaid"])->nullable();
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
