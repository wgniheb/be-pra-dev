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
        Schema::create('healthy_facilities', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_posyandu');
            $table->boolean('is_puskesmas');
            $table->boolean('is_pustu');
            $table->boolean('is_polindes');
            $table->boolean('is_klinik');
            $table->boolean('is_rs');
            $table->boolean('is_poskesdes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthy_facilities');
    }
};
