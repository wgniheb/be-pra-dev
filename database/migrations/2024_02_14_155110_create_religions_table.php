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
        Schema::create('religions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_islam');
            $table->boolean('is_kristen');
            $table->boolean('is_katolik');
            $table->boolean('is_hindu');
            $table->boolean('is_budha');
            $table->boolean('is_konghucu');
            $table->boolean('is_kaharingan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('religions');
    }
};
