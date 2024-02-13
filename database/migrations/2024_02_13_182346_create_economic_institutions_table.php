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
        Schema::create('economic_institutions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_bank');
            $table->boolean('is_koperasi');
            $table->boolean('is_credit_union');
            $table->boolean('is_brilink');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('economic_institutions');
    }
};
