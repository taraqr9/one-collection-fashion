<?php

use App\Enums\OrderPaymentMethodEnum;
use App\Enums\OrderStatusEnum;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // customer
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_address')->nullable();
            $table->string('order_number')->unique();
            $table->integer('total_amount');
            $table->integer('discount')->default(0);
            $table->integer('final_amount');
            $table->string('payment_method')->default(OrderPaymentMethodEnum::CashOnDelivery->value);
            $table->string('status')->default(OrderStatusEnum::Pending->value); // pending, paid, shipped, completed, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
