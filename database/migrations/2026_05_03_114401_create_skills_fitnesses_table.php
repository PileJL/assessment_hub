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
        Schema::create('skills_fitnesses', function (Blueprint $table) {
            $table->id('skillsFitnessID');
            $table->foreignId('applicantID')->constrained('applicants', 'applicantID')->cascadeOnDelete();
            $table->decimal('agilityTtestResult', 5, 2)->nullable();
            $table->decimal('standingLongJumpResult', 5, 2)->nullable();
            $table->decimal('hexagonAgilityResult', 5, 2)->nullable();
            $table->decimal('fortyYardDashResult', 5, 2)->nullable();
            $table->decimal('storkBalanceStandResult', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills_fitnesses');
    }
};
