<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Khóa ngoại
            $table->text('answer_text'); // Nội dung câu trả lời
            $table->boolean('is_correct'); // Đánh dấu câu trả lời đúng
            $table->timestamps(); // Timestamps cho created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
