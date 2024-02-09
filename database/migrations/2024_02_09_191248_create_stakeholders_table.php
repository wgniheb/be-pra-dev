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
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->unsignedBigInteger('stakeholder_category_id')->nullable();
            $table->foreign('stakeholder_category_id')->references('id')->on('stakeholder_categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stakeholders', function (Blueprint $table) {
            $table->dropForeign(['stakeholder_category_id']);
            $table->dropColumn('stakeholder_category_id');
        });
        Schema::dropIfExists('stakeholders');
    }
};
