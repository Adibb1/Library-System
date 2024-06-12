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
        Schema::table('books', function (Blueprint $table) {
            $table->foreign(['category_id'], 'books_fk6')->references(['id'])->on('categories')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['language_id'], 'books_ibfk_1')->references(['id'])->on('languages')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_fk6');
            $table->dropForeign('books_ibfk_1');
        });
    }
};
