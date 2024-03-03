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
        Schema::create('stakeholder_has_villages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stakeholder_id');
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders');
            $table->unsignedBigInteger('village_id');
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
        Schema::table('stakeholder_has_villages', function (Blueprint $table) {
            $table->dropForeign(['stakeholder_id']);
            $table->dropForeign(['village_id']);
        });
        Schema::dropIfExists('stakeholder_has_villages');
    }
};
