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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('shop_id')->index();
            $table->uuid('id')->primary();

            $table->string('crn');
            $table->string('name');
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->boolean('is_deleted')->default(false);

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};