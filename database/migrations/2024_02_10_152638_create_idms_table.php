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
        Schema::create('idms', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->decimal('score', 5, 2);
            $table->unsignedBigInteger('idm_status_id')->nullable();
            $table->foreign('idm_status_id')->references('id')->on('idm_statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('idms', function (Blueprint $table) {
            $table->dropForeign(['idm_status_id']);
            $table->dropColumn('idm_status_id');
        });
        Schema::dropIfExists('idms');
    }
};
