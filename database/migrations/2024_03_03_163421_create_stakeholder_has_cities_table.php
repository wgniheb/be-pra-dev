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
        Schema::create('stakeholder_has_cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stakeholder_id');
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stakeholder_has_cities', function (Blueprint $table) {
            $table->dropForeign(['stakeholder_id']);
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('stakeholder_has_cities');
    }
};
