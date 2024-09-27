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
        Schema::create('other_criteria', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('monarch', 255)->nullable();
            $table->smallInteger('reign_period_from')->nullable();
            $table->smallInteger('reign_period_to')->nullable();
            $table->smallInteger('mintage_year')->nullable();
            $table->string('avers', 255)->nullable();
            $table->string('revers', 255)->nullable();
            $table->string('coin_edge', 255)->nullable();
            $table->smallInteger('century')->nullable();
            $table->string('metal', 255)->nullable();
            $table->string('quality', 255)->nullable();
            $table->bigInteger('price_by_krause')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_criteria');
    }
};
