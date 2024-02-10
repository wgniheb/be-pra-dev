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
        Schema::create('community_profilings', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->unsignedBigInteger('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_profilings', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
            $table->dropColumn('village_id');
        });
        Schema::dropIfExists('community_profilings');
    }
};
