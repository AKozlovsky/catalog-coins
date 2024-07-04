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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->char('currency', 3);
            $table->smallInteger('numerical_value');
            $table->bigInteger('photo');
            $table->bigInteger('other_criteria');
            $table->bigInteger('collection')->unique();
            $table->timestamps();
            $table->foreign('currency')->references('code')->on('currencies');
            $table->foreign('numerical_value')->references('value')->on('numerical_values');
            $table->foreign('photo')->references('item')->on('photos');
            $table->foreign('other_criteria')->references('item')->on('other_criteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
