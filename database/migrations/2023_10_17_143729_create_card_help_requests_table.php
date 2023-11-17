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
        Schema::create('card_help_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('mobile_number', 20);
            $table->string('city', 30);
            $table->string('profession', 50)->nullable();
            $table->string('status', 12)->default('NEW')->comment('NEW/CONTACTED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_queries');
    }
};
