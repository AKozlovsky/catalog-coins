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
            $table->bigInteger('item')->unique();
            $table->string('monarch', 255);
            $table->smallInteger('reign_period_from');
            $table->smallInteger('reign_period_to');
            $table->smallInteger('mintage_year');
            $table->string('avers', 255);
            $table->string('revers', 255);
            $table->string('coin_edge', 255);
            $table->smallInteger('century');
            $table->string('metal', 255);
            $table->string('quality', 255);
            $table->bigInteger('price_by_krause');
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
