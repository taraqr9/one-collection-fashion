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
        Schema::create('career_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('department', 100);
            $table->string('salary_range', 30);
            $table->string('employment_status',20);
            $table->string('location', 100);
            $table->dateTime('deadline');
            $table->unsignedTinyInteger('no_of_vacancy');
            $table->text('job_details')->nullable();
            $table->string('status', 12)->index('status_index')->default('ACTIVE')->comment('ACTIVE/INACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_jobs');
    }
};
