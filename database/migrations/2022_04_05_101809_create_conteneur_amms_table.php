<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConteneurAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteneur_amms', function (Blueprint $table) {
            $table->id();
            $table->string('nomnavire', 200)->nullable();
            $table->string('numvoyage', 200)->nullable();
            $table->string('numbietc', 200)->nullable();
            $table->string('numconteneur', 200)->nullable();
            $table->string('numconnaissement', 200)->nullable();
            $table->integer('idamm')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idamm')->references('id')->on('amms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conteneur_amms');
    }
}
