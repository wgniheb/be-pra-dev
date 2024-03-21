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
        Schema::create('issue_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_id');
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->unsignedBigInteger('matrix_id');
            $table->foreign('matrix_id')->references('id')->on('issue_matrices');
            $table->integer('score');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_analyses', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);
            $table->dropForeign(['matrix_id']);
        });
        Schema::dropIfExists('issue_analyses');
    }
};
