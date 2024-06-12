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
        Schema::create('books', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->string('author');
            $table->string('ISBN');
            $table->string('description');
            $table->string('picture')->nullable();
            $table->integer('category_id')->index('books_fk6');
            $table->integer('price');
            $table->integer('language_id')->index('language_id');
            $table->integer('loaned')->default(0);
            $table->boolean('trending')->default(false);
            $table->boolean('recommended')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
