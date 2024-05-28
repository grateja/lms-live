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
        if(!Schema::hasTable('shop_user')) {
            Schema::create('shop_user', function (Blueprint $table) {
                $table->uuid('user_id')->index();
                $table->uuid('shop_id')->index();

                $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('shop_id')->references('id')->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
