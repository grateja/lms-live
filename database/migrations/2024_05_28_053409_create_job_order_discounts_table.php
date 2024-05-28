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
        Schema::create('job_order_discounts', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();
            $table->uuid('discount_id');
            $table->string('name');
            $table->float('value')->default(0);
            $table->text('applicable_to');
            $table->timestamps();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('void')->default(0);

            $table->foreign('discount_id')->references('id')->on('discounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id')->references('id')->on('job_orders')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_discounts');
    }
};
