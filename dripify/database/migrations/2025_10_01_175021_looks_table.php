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
        Schema::create('looks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('look_id');
            $table->uuid('clothing_id');
            $table->uuid('user_id' );
            $table->string('tag', 255)->nullable();


            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('clothing_id')
                ->references('id')->on('clothing')
                ->onDelete('cascade');

            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('looks');
    }
};
