<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_premium_subscriptions', function (Blueprint $table) {
            // Xóa cột payment_id
            $table->dropColumn('payment_id');

            // Thêm cột amount và app_trans_id
            $table->decimal('amount', 10, 2)->nullable(); // Giả sử amount là một số thập phân
            $table->string('app_trans_id')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('user_premium_subscriptions', function (Blueprint $table) {
            // Thêm lại cột payment_id
            $table->string('payment_id')->nullable();

            // Xóa cột amount và app_trans_id
            $table->dropColumn('amount');
            $table->dropColumn('app_trans_id');
        });
    }
};
