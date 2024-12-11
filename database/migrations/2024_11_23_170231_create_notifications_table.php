<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->unsignedBigInteger('user_id'); // Cột user_id để liên kết với bảng users
            $table->string('title'); // Tiêu đề thông báo
            $table->text('message'); // Nội dung thông báo
            $table->string('type')->default('info'); // Loại thông báo (info, warning, error, ...)
            $table->boolean('is_read')->default(false); // Trạng thái đã đọc
            $table->timestamps(); // created_at và updated_at

            // Gắn khóa ngoại cho user_id
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Xóa người dùng thì xóa luôn thông báo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
