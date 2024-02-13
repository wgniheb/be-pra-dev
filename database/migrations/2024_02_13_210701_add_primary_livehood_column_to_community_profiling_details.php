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
            $table->unsignedBigInteger('primary_livelihood_id')->nullable()->after('economic_institution_id');
            $table->foreign('primary_livelihood_id')->references('id')->on('primary_livelihoods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['primary_livelihood_id']);
            $table->dropColumn('primary_livelihood_id');
        });
    }
};
