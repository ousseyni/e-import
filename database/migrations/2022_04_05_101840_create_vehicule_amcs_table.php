<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculeAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicule_amcs', function (Blueprint $table) {
            $table->id();
            $table->string('numlvi', 200)->nullable();
            $table->string('numvehicule', 200)->nullable();
            $table->string('numconteneur', 200)->nullable();
            $table->string('numplomb', 200)->nullable();
            $table->integer('idamc')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idamc')->references('id')->on('amcs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicule_amcs');
    }
}
