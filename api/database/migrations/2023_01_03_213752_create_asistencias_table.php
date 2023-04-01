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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->unsignedBigInteger('validacione_id')->nullable();
            $table->unsignedBigInteger('materiauser_id')->nullable();
            //$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mensaje_id')->nullable();
            $table->text('mensaje');
            $table->foreign('validacione_id')->references('id')->on('validaciones')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('materiauser_id')->references('id')->on('materiausers')->onUpdate('cascade')->onDelete('set null');
            //$table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mensaje_id')->references('id')->on('mensajes')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('asistencias');
    }
};
