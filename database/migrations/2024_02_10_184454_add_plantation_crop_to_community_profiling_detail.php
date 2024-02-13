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
            $table->unsignedBigInteger('plantation_crop_id')->nullable()->after('farm_product_id');
            $table->foreign('plantation_crop_id')->references('id')->on('plantation_crops');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['plantation_crop_id']);
            $table->dropColumn('plantation_crop_id');
        });
    }
};
