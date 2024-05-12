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
        Schema::create('completed_treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('patient_id')->nullable();
            $table->unsignedInteger('doctor_id')->nullable();
            $table->string('treatment_name');
            $table->unsignedInteger('payment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_treatments');
    }
};
