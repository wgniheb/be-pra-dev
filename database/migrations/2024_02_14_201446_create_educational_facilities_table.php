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
        Schema::create('educational_facilities', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_paud');
            $table->boolean('is_tk');
            $table->boolean('is_sd');
            $table->boolean('is_smp');
            $table->boolean('is_sma');
            $table->boolean('is_pt');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_facilities');
    }
};
