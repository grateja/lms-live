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
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();
            $table->string('name');
            $table->float('price')->default(0);
            $table->text('svc_machine_type')->nullable();
            $table->text('svc_wash_type')->nullable();
            $table->integer('svc_minutes')->nullable();
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
        Schema::dropIfExists('services');
    }
};
