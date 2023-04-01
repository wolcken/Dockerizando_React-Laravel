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
        Schema::create('cursoparalelos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('paralelo_id')->nullable();
            $table->unsignedBigInteger('nivele_id')->nullable();
            $table->unsignedBigInteger('colegio_id')->nullable();
            $table->foreign('curso_id')->references('id')->on('cursos')->onUpdate('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->onUpdate('set null');
            $table->foreign('nivele_id')->references('id')->on('niveles')->onUpdate('set null');
            $table->foreign('colegio_id')->references('id')->on('colegios')->onUpdate('set null');
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
        Schema::dropIfExists('cursoparalelos');
    }
};
