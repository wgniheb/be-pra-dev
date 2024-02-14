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
        Schema::create('road_conditions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_aspal');
            $table->boolean('is_cor');
            $table->boolean('is_tanah');
            $table->boolean('is_batu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_conditions');
    }
};
