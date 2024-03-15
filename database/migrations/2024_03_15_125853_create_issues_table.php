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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('issue_detail');
            $table->unsignedBigInteger('issue_category_id');
            $table->foreign('issue_category_id')->references('id')->on('issue_categories');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('entities');
            $table->unsignedBigInteger('stakeholder_id');
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders');
            $table->unsignedBigInteger('published_status_id');
            $table->foreign('published_status_id')->references('id')->on('published_statuses');
            $table->string('period');
            $table->text('stakeholder_perception');
            $table->unsignedBigInteger('issue_status_id');
            $table->foreign('issue_status_id')->references('id')->on('issue_statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropForeign(['issue_category_id']);
            $table->dropForeign(['entity_id']);
            $table->dropForeign(['stakeholder_id']);
            $table->dropForeign(['published_status_id']);
            $table->dropForeign(['issue_status_id']);
        });
        Schema::dropIfExists('issues');
    }
};
