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
        Schema::create('secondary_livelihoods', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_karyawan_swasta');
            $table->boolean('is_pns');
            $table->boolean('is_wirausaha');
            $table->boolean('is_penggarap_lahan');
            $table->boolean('is_nelayan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secondary_livelihoods');
    }
};
