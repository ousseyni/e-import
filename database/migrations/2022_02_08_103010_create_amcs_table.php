<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amcs', function (Blueprint $table) {
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
            $table->string('numconteneur', 200);
            $table->string('numconnaissement', 200);
            $table->date('dateembarque');
            $table->string('lieuembarque',100);
            $table->date('datedebarque');
            $table->string('lieudebarque',100);
            $table->integer('totalamc');
            $table->integer('totalpen');
            $table->string('observation',250);
            $table->integer('totalpoids');
            $table->integer('valeurcaf')->nullable();
            $table->integer('consoservice')->nullable();
            $table->integer('idcontribuable')->unsigned();
            $table->string('slug', 100);
            $table->tinyInteger('etat')->default('1');
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
        Schema::dropIfExists('amcs');
    }
}
