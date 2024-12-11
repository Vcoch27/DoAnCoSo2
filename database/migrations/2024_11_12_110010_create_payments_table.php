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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('premium_plan_id')->constrained('premium_plans')->onDelete('cascade');
            $table->string('app_trans_id', 50); // Mã giao dịch hệ thống
            $table->decimal('amount', 10, 2); // Số tiền thanh toán
            $table->enum('payment_status', ['success', 'failed', 'pending']); // Trạng thái thanh toán
            $table->string('zp_trans_token', 100); // Token giao dịch của ZaloPay
            $table->string('order_url', 255); // URL để chuyển hướng thanh toán
            $table->text('description'); // Mô tả về đơn hàng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
