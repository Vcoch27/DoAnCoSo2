<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPremiumAndDailyLimitToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột is_premium
            $table->boolean('is_premium')->default(false); // Mặc định là false (người dùng không phải premium)

            // Thêm cột daily_limit để lưu trữ số lượt còn lại mỗi ngày
            $table->integer('daily_limit')->default(4); // Mặc định là 4 lượt cho người dùng không trả phí
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa các cột đã thêm khi rollback migration
            $table->dropColumn('is_premium');
            $table->dropColumn('daily_limit');
        });
    }
}
