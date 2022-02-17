<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amms', function (Blueprint $table) {
            $table->id();
            $table->string('numfact', 20);
            $table->date('datefact');
            $table->string('paysorig', 50);
            $table->string('paysprov', 50);
            $table->string('fournisseur', 200);
            $table->string('nomnavire', 200)->nullable();
            $table->string('cieaerien', 200)->nullable();
            $table->string('numvehicul', 200)->nullable();
            $table->string('numvoyage', 200)->nullable();
            $table->string('numconteneur', 200)->nullable();
            $table->string('numconnaissement', 200)->nullable();
            $table->date('dateembarque')->nullable();
            $table->string('lieuembarque',100)->nullable();
            $table->date('datedebarque')->nullable();
            $table->string('lieudebarque',100);
            $table->integer('totalamm')->nullable();
            $table->integer('totalpen')->nullable();
            $table->string('observation',250)->nullable();
            $table->integer('totalpoids')->nullable();
            $table->integer('valeurcaf')->nullable();
            $table->integer('consoservice')->nullable();
            $table->integer('idcontribuable')->unsigned()->nullable();
            $table->string('slug', 100);
            $table->integer('etat')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('idcontribuable')->references('id')->on('contribuables')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amms');
    }
}
