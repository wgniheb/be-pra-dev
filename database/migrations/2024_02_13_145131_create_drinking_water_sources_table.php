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
        Schema::create('drinking_water_sources', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_sungai');
            $table->boolean('is_sumur');
            $table->boolean('is_air_hujan');
            $table->boolean('is_galon');
            $table->boolean('is_pamsimas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinking_water_sources');
    }
};
