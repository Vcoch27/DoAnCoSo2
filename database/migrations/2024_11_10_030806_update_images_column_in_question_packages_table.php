<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImagesColumnInQuestionPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_packages', function (Blueprint $table) {
            // Đặt giá trị mặc định cho cột 'images' là 'hinh1.jpg'
            $table->string('images')->default('hinh1.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_packages', function (Blueprint $table) {
            // Hoàn tác thay đổi (nếu cần)
            $table->string('images')->nullable()->change();
        });
    }
}
