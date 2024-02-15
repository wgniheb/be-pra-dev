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
        Schema::create('worship_facilities', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_masjid');
            $table->boolean('is_gereja_kristen');
            $table->boolean('is_gereja_katolik');
            $table->boolean('is_pura');
            $table->boolean('is_vihara');
            $table->boolean('is_balai_besarah');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worship_facilities');
    }
};
