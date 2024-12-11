<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->integer('question_count')->default(0);
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->double('rating')->default(0);
            $table->integer('attempt_count')->default(0);
            $table->timestamps();

            // Thiết lập khóa ngoại cho author_id (nếu có bảng users)
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_packages');
    }
};
