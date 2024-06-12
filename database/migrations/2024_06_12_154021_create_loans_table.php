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
        Schema::create('loans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('loans_fk1');
            $table->integer('book_id')->index('loans_fk2');
            $table->string('name');
            $table->date('loan_date');
            $table->integer('testimoni_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
