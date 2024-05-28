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
        Schema::create('job_order_delivery_charges', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();
            $table->uuid('delivery_profile_id');
            $table->text('vehicle');
            $table->text('delivery_option');
            $table->float('price')->default(0);
            $table->float('distance')->default(0);
            $table->timestamps();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('void')->default(0);

            $table->foreign('delivery_profile_id')->references('id')->on('delivery_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id')->references('id')->on('job_orders')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_delivery_charges');
    }
};
