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
            $table->unsignedBigInteger('mean_of_transportation_id')->nullable()->after('group_id');
            $table->foreign('mean_of_transportation_id')->references('id')->on('mean_of_transportations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['mean_of_transportation_id']);
            $table->dropColumn('mean_of_transportation_id');
        });
    }
};
