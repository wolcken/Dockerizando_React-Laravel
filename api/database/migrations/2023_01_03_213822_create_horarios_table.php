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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dia_id')->nullable();
            $table->unsignedBigInteger('nivele_id')->nullable();
            $table->unsignedBigInteger('cursoparalelo_id');
            //$table->unsignedBigInteger('paralelo_id');
            $table->unsignedBigInteger('materiauser_id')->nullable();
            //$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('periodo_id')->nullable();
            $table->foreign('dia_id')->references('id')->on('dias')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('nivele_id')->references('id')->on('niveles')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('cursoparalelo_id')->references('id')->on('cursoparalelos')->onUpdate('cascade')->onDelete('cascade');
            //$table->foreign('paralelo_id')->references('id')->on('paralelos');
            $table->foreign('materiauser_id')->references('id')->on('materiausers')->onUpdate('cascade')->onDelete('set null');
            //$table->foreign('user_id')->references('id')->on('users');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('horarios');
    }
};
