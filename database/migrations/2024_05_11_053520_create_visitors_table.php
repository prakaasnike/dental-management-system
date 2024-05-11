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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ["checked_in","completed"]);
            $table->string('phone')->nullable();
            $table->enum('gender', ["male","female","other"]);
            $table->date('dob');
            $table->text('description');
            $table->date('visitor_date');
            $table->decimal('visitor_payment', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
