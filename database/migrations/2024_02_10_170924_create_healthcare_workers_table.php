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
        Schema::create('healthcare_workers', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_dokter');
            $table->boolean('is_perawat');
            $table->boolean('is_mantri');
            $table->boolean('is_bidan');
            $table->boolean('is_dukun');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcare_workers');
    }
};
