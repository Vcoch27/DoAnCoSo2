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
        Schema::table('package_tag', function (Blueprint $table) {
            // Thêm khóa ngoại cho package_id
            $table->foreign('package_id')->references('id')->on('question_packages')->onDelete('cascade');

            // Thêm khóa ngoại cho tag_id
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_tag', function (Blueprint $table) {
            // Hủy bỏ khóa ngoại
            $table->dropForeign(['package_id']);
            $table->dropForeign(['tag_id']);
        });
    }
};
