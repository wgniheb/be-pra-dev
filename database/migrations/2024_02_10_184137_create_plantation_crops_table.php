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
        Schema::create('plantation_crops', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_sawit');
            $table->boolean('is_karet');
            $table->boolean('is_kelapa');
            $table->boolean('is_kopi');
            $table->boolean('is_kakao');
            $table->boolean('is_lada');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantation_crops');
    }
};
