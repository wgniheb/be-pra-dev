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
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->unsignedBigInteger('sanitation_water_source_id')->nullable()->after('drinking_water_source_id');
            $table->foreign('sanitation_water_source_id')->references('id')->on('sanitation_water_sources');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['sanitation_water_source_id']);
            $table->dropColumn('sanitation_water_source_id');
        });
    }
};
