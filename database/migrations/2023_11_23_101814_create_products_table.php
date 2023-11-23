<?php

use App\Enums\ProductStatusEnum;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('parent_id')->nullable()
                ->constrained('products')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('offer_price')->default(0);
            $table->integer('stock')->default(0);
            $table->tinyInteger('status')->default(ProductStatusEnum::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
