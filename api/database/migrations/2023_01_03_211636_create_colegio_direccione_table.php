<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegio_direccione', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colegio_id')->unique();
            $table->unsignedBigInteger('direccione_id');
            $table->foreign('colegio_id')->references('id')->on('colegios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('direccione_id')->references('id')->on('direcciones')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colegio_direccione');
    }
};
