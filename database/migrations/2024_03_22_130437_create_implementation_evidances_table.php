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
        Schema::create('implementation_evidances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_implementation_id');
            $table->foreign('issue_implementation_id')->references('id')->on('issue_implementations');
            $table->string('evidance');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('implementation_evidances', function (Blueprint $table) {
            $table->dropForeign(['issue_implementation_id']);
        });
        Schema::dropIfExists('implementation_evidances');
    }
};
