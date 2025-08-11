<?php

use App\Enums\StatusEnum;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Human-readable: "Top Banner"
            $table->string('key')->unique()->index();   // e.g., 'top_banner', 'footer_links'
            $table->string('type');                     // 'image' | 'text' | 'json'
            $table->json('value')->nullable();          // store path/string/arrays as JSON
            $table->string('url')->nullable();          // optional click-through link for banners
            $table->string('status')->default(StatusEnum::Active->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
