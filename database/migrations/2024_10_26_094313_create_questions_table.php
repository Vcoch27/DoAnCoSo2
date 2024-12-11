<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_package_id')->constrained()->onDelete('cascade'); // Khóa ngoại
            $table->text('question_text'); // Nội dung câu hỏi
            $table->timestamps(); // Timestamps cho created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
