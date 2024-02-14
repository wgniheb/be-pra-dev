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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_melayu');
            $table->boolean('is_jawa');
            $table->boolean('is_banjar');
            $table->boolean('is_batak');
            $table->boolean('is_minang');
            $table->boolean('is_dayak');
            $table->boolean('is_flores');
            $table->boolean('is_bugis');
            $table->boolean('is_papua');
            $table->boolean('is_manado');
            $table->boolean('is_toraja');
            $table->boolean('is_timor');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
