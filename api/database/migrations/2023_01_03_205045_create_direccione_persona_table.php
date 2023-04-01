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
        Schema::create('direccione_persona', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direccione_id');
            $table->unsignedBigInteger('persona_id')->unique();
            $table->foreign('direccione_id')->references('id')->on('direcciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('direccione_persona');
    }
};
