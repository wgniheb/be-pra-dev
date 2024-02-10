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
        Schema::create('community_profiling_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_profiling_id');
            $table->foreign('community_profiling_id')->references('id')->on('community_profilings');
            $table->unsignedBigInteger('idm_id');
            $table->foreign('idm_id')->references('id')->on('idms');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['community_profiling_id']);
            $table->dropForeign(['idm_id']);
            $table->dropColumn('community_profiling_id');
            $table->dropColumn('idm_id');
        });
        Schema::dropIfExists('community_profiling_details');
    }
};
