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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();
            $table->string('name');
            $table->float('price')->default(0);
            $table->float('current_stock')->default(0);
            $table->text('measure_unit');
            $table->float('unit_per_serve')->default(0);
            $table->text('product_type')->nullable();
            $table->timestamps();
            $table->boolean('is_deleted')->default(0);

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
