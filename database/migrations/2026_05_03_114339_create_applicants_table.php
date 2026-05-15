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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id('applicantID');
            $table->string('fullName');
            $table->boolean('isPassed');
            $table->decimal('height', 5, 2)->comment('Height in meters');
            $table->decimal('weight', 5, 2)->comment('Weight in kilograms');
            $table->timestamp('timestampCreatedAt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
