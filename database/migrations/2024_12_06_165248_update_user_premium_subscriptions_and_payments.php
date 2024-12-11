<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserPremiumSubscriptionsAndPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update user_premium_subscriptions table
        Schema::table('user_premium_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->nullable()->after('premium_plan_id');
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onDelete('set null');
        });

        // Ensure the payments table has necessary fields
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_premium_subscriptions', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
            $table->dropColumn('payment_id');
        });

        // Optionally revert changes to the payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_status')->change();
        });
    }
}
