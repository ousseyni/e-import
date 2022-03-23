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
            $table->string('paysprov', 50);
            $table->string('modetransport', 100);
            $table->string('fournisseur', 200);
            $table->string('cieaerien', 200)->nullable();
            $table->string('numvoyagea', 200)->nullable();
            $table->string('nomnavire', 200)->nullable();
            $table->string('numvoyagem', 200)->nullable();
            $table->string('numvehicul', 200)->nullable();
            $table->string('numvoyaget', 200)->nullable();
            $table->string('numwagon', 200)->nullable();
            $table->string('numvoyagef', 200)->nullable();
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
            $table->integer('idcontribuable')->unsigned()->nullable();
            $table->string('slug', 100);
            $table->integer('etat')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('idcontribuable')->references('id')->on('contribuables')->nullOnDelete();
            $table->foreign('etat')->references('id')->on('etat_demandes')->nullOnDelete();
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
