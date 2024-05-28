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
        Schema::create('job_order_extras', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();
            $table->uuid('job_order_id');
            $table->uuid('extras_id');
            $table->string('extras_name');
            $table->float('price')->default(0);
            $table->integer('quantity')->default(0);

            $table->timestamps();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('void')->default(0);

            $table->foreign('job_order_id')->references('id')->on('job_orders')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('extras_id')->references('id')->on('extras')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_extras');
    }
};
