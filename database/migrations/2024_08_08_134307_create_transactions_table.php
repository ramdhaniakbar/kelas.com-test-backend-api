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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->text('product_detail');
            $table->integer('admin_fee')->default(0);
            $table->integer('platform_fee')->default(0);
            $table->integer('ppn_amount')->default(0);
            $table->integer('total_deduction')->default(0);
            $table->bigInteger('bill_amount')->default(0);
            $table->bigInteger('total_bill_amount')->default(0);
            $table->bigInteger('total_net_amount')->default(0);
            $table->bigInteger('npat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
