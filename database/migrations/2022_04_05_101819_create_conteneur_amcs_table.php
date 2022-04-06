<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConteneurAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteneur_amcs', function (Blueprint $table) {
            $table->id();
            $table->string('nomnavire', 200)->nullable();
            $table->string('numvoyage', 200)->nullable();
            $table->string('numbietc', 200)->nullable();
            $table->string('numconteneur', 200)->nullable();
            $table->string('numconnaissement', 200)->nullable();
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
        Schema::dropIfExists('conteneur_amcs');
    }
}
