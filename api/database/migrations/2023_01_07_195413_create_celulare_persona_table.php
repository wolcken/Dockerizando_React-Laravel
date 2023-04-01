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
        Schema::create('celulare_persona', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('celulare_id');
            $table->unsignedBigInteger('persona_id');
            $table->foreign('celulare_id')->references('id')->on('celulares')->onUpdate('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onUpdate('cascade');
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
        Schema::dropIfExists('celulare_persona');
    }
};
