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
        Schema::create('package_services', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();
            $table->uuid('package_id');
            $table->uuid('service_id');
            $table->float('quantity')->default(0);
            $table->timestamps();
            $table->boolean('is_deleted')->default(0);

            $table->foreign('package_id')->references('id')->on('packages')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_services');
    }
};
