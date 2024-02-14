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
            $table->unsignedBigInteger('electricity_id')->nullable()->after('mean_of_transportation_id');
            $table->foreign('electricity_id')->references('id')->on('electricities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['electricity_id']);
            $table->dropColumn('electricity_id');
        });
    }
};
