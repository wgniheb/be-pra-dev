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
        Schema::create('stakeholder_profiling_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stakeholder_profiling_id');
            $table->foreign('stakeholder_profiling_id')->references('id')->on('stakeholder_profilings');
            $table->integer('k_s1_q1');
            $table->integer('k_s1_q2');
            $table->integer('k_s1_q3');
            $table->integer('k_s1_q4');
            $table->integer('k_s1_q5');
            $table->integer('k_s2_q1');
            $table->integer('k_s2_q2');
            $table->integer('k_s2_q3');
            $table->integer('k_s2_q4');
            $table->integer('k_s2_q5');
            $table->integer('k_s2_q6');
            $table->integer('k_s2_q7');
            $table->integer('k_s2_q8');
            $table->integer('p_s1_q1');
            $table->integer('p_s1_q2');
            $table->integer('p_s1_q3');
            $table->integer('p_s1_q4');
            $table->integer('p_s1_q5');
            $table->integer('p_s1_q6');
            $table->integer('p_s1_q7');
            $table->integer('p_s2_q1');
            $table->integer('p_s2_q2');
            $table->integer('p_s2_q3');
            $table->integer('p_s2_q4');
            $table->integer('p_s2_q5');
            $table->integer('p_s2_q6');
            $table->integer('p_s2_q7');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stakeholder_profiling_details', function (Blueprint $table) {
            $table->dropForeign(['stakeholder_profiling_id']);
            $table->dropColumn('stakeholder_profiling_id');
        });
        Schema::dropIfExists('stakeholder_profiling_details');
    }
};
