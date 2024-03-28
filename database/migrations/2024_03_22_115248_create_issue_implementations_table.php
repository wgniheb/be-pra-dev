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
        Schema::create('issue_implementations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_id');
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->unsignedBigInteger('issue_solution_id');
            $table->foreign('issue_solution_id')->references('id')->on('issue_solutions');
            $table->string('name');
            $table->text('description');
            $table->date('date_implementation');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_implementations', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);
            $table->dropForeign(['issue_solution_id']);
        });
        Schema::dropIfExists('issue_implementations');
    }
};
