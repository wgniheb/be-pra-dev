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
            $table->unsignedBigInteger('secondary_livelihood_id')->nullable()->after('primary_livelihood_id');
            $table->foreign('secondary_livelihood_id')->references('id')->on('secondary_livelihoods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['secondary_livelihood_id']);
            $table->dropColumn('secondary_livelihood_id');
        });
    }
};
