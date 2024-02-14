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
        Schema::create('mean_of_transportations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_bus');
            $table->boolean('is_angkot');
            $table->boolean('is_sepeda_motor');
            $table->boolean('is_mobil');
            $table->boolean('is_perahu');
            $table->boolean('is_becak');
            $table->boolean('is_kereta_api');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mean_of_transportations');
    }
};
