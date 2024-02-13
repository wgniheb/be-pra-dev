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
        Schema::create('primary_livelihoods', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_petani');
            $table->boolean('is_pekebun');
            $table->boolean('is_pns');
            $table->boolean('is_karyawan_swasta');
            $table->boolean('is_wirausaha');
            $table->boolean('is_nelayan');
            $table->boolean('is_jasa');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_livelihoods');
    }
};
