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
        Schema::table('testimonies', function (Blueprint $table) {
            $table->foreign(['loan_id'], 'testimonies_ibfk_1')->references(['id'])->on('loans')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'testimonies_ibfk_2')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['book_id'], 'testimonies_ibfk_3')->references(['id'])->on('books')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonies', function (Blueprint $table) {
            $table->dropForeign('testimonies_ibfk_1');
            $table->dropForeign('testimonies_ibfk_2');
            $table->dropForeign('testimonies_ibfk_3');
        });
    }
};
