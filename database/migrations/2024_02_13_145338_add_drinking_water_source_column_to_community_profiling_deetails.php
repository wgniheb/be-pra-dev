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
            $table->unsignedBigInteger('drinking_water_source_id')->nullable()->after('fishery_id');
            $table->foreign('drinking_water_source_id')->references('id')->on('drinking_water_sources');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['drinking_water_source_id']);
            $table->dropColumn('drinking_water_source_id');
        });
    }
};
