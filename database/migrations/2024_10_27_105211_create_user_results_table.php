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
        Schema::create('user_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('question_package_id'); // ID gói câu hỏi
            $table->integer('cumulative_points')->default(0); // Điểm tích lũy người dùng đạt được của người dùng
            $table->decimal('percent', 5, 2)->default(0); // Phần trăm chính xác
            $table->text('user_choices'); // Chuỗi JSON lưu lựa chọn của người dùng cho từng câu
            $table->timestamp('completed_at')->nullable(); // Thời gian hoàn thành
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_package_id')->references('id')->on('question_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_results');
    }
};
