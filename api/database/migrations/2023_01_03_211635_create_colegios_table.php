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
        Schema::create('colegios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('turno_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            //$table->unsignedBigInteger('address_id');
            $table->foreign('turno_id')->references('id')->on('turnos')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('set null');
            //$table->foreign('address_id')->references('id')->on('direcciones');
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
        Schema::dropIfExists('colegios');
    }
};
