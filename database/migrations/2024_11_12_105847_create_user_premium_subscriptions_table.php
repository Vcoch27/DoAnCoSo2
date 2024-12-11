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
        Schema::create('user_premium_subscriptions', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết tới bảng users
            $table->foreignId('premium_plan_id')->constrained('premium_plans')->onDelete('cascade'); // Khóa ngoại liên kết tới bảng premium_plans
            $table->enum('status', ['active', 'expired', 'pending']); // Trạng thái đăng ký
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps(); // Ngày tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_premium_subscriptions');
    }
};
