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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('password');
            $table->string('email');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
            $table->rememberToken();
            $table->boolean('isAdmin')->default(false);
            $table->string('profile_picture')->default('http://127.0.0.1:8000/storage/default-pfp.webp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
