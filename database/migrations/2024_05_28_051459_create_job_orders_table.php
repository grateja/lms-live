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
        Schema::create('job_orders', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();

            $table->string('job_order_number');
            $table->uuid('customer_id')->index();
            $table->uuid('staff_id')->index();
            $table->float('subtotal')->default(0);
            $table->float('discount_in_peso')->default(0);
            $table->float('discounted_amount')->default(0);
            $table->uuid('job_order_payment_id')->index()->nullable();

            $table->uuid('void_by')->index()->nullable();
            $table->text('void_remarks')->nullable();
            $table->timestamp('void_date')->nullable();

            $table->timestamps();
            $table->boolean('is_deleted')->default(false);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_order_payment_id')->references('id')->on('job_order_payments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('void_by')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_orders');
    }
};
