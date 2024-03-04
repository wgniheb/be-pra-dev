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
        Schema::create('stakeholder_profilings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stakeholder_id');
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders');
            $table->integer('year');
            $table->unsignedBigInteger('stakeholder_kuadran_id')->nullable();
            $table->foreign('stakeholder_kuadran_id')->references('id')->on('stakeholder_kuadrans');
            $table->double('power_point', 5, 2);
            $table->double('interest_point', 5, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stakeholder_profilings', function (Blueprint $table) {
            $table->dropForeign(['stakeholder_id']);
            $table->dropColumn('stakeholder_id');
            $table->dropForeign(['stakeholder_kuadran_id']);
            $table->dropColumn('stakeholder_kuadran_id');
        });
        Schema::dropIfExists('stakeholder_profilings');
    }
};
