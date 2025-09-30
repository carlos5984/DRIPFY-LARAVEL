<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clothing', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('clothing_name', 255);
            $table->string('clothing_path', 255);
            $table->text('clothing_description');
            $table->boolean('available')->default(true);
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    public function down(): void
    {

    }
};

//CREATE TABLE IF NOT EXISTS clothing (
//    id CHAR(32) PRIMARY KEY,
//    user_id CHAR(32) NOT NULL,
//    clothing_name VARCHAR(255),
//    clothing_path VARCHAR(255) NOT NULL,
//    clothing_description TEXT,
//    available BOOLEAN DEFAULT TRUE,
//    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
//) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
