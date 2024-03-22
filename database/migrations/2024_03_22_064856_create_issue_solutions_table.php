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
        Schema::create('issue_solutions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_id');
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('target');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_solutions', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);
        });
        Schema::dropIfExists('issue_solutions');
    }
};
