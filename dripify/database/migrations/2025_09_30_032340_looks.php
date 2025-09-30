<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('looks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('clothing_id')->references('id')->on('clothing')->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('tag')->nullable();
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');
            $table->timestamps();
        });

        /*
        CREATE TABLE IF NOT EXISTS looks (
            look_id CHAR(32) NOT NULL,
            clothing_id CHAR(32) NOT NULL,
            user_id CHAR(32) NOT NULL,
            tag VARCHAR(255),
            PRIMARY KEY (look_id, clothing_id),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (clothing_id) REFERENCES clothing(id) ON DELETE CASCADE
        ) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        */


        Schema::table('clothing', function (Blueprint $table) {
            $table->timestamps();
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('looks');

    }
};

