<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculeAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicule_amms', function (Blueprint $table) {
            $table->id();
            $table->string('numlvi', 200)->nullable();
            $table->string('numvehicule', 200)->nullable();
            $table->string('numconteneur', 200)->nullable();
            $table->string('numplomb', 200)->nullable();
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
        Schema::dropIfExists('vehicule_amms');
    }
}
