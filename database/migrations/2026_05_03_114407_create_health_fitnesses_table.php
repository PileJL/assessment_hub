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
        Schema::create('health_fitnesses', function (Blueprint $table) {
            $table->id('healthFitnessID');
            $table->foreignId('applicantID')->constrained('applicants', 'applicantID')->cascadeOnDelete();
            $table->integer('pushUpsResult')->nullable(); // Count
            $table->decimal('sitAndReachResult', 5, 2)->nullable(); // Centimeters
            $table->integer('threeMinStepBeforeResult')->nullable(); // Heart rate / Beats per minute
            $table->integer('threeMinStepAfterResult')->nullable(); // Heart rate / Beats per minute
            $table->decimal('plankTestResult', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_fitnesses');
    }
};
