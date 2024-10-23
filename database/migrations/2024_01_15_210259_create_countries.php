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
        Schema::create('countries', function (Blueprint $table) {
            $table->char('code', 2);
            $table->char('continent_code', 2);
            $table->string('country_name', 255);
            $table->string('full_name', 255);
            $table->primary('code');
            $table->timestamps();
            $table->foreign('continent_code')->references('code')->on('continents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
