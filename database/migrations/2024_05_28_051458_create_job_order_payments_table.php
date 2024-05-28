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
        Schema::create('job_order_payments', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();

            $table->string('payment_method');
            $table->float('amount_due')->default(0);
            $table->float('cash_received')->default(0);
            $table->uuid('staff_id');
            $table->string('or_number')->nullable();

            $table->string('cashless_provider')->nullable();
            $table->string('cashless_ref_number')->nullable();
            $table->float('cashless_amount')->nullable();

            $table->timestamps();
            $table->boolean('is_deleted')->default(false);

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_payments');
    }
};
