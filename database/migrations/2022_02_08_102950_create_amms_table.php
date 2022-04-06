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
            $table->string('paysprov', 50);
            $table->string('modetransport', 100);

            //$table->string('numlta', 100)->nullable();
            //$table->string('cieaerien', 200)->nullable();
            //$table->string('numvol', 100)->nullable();

            //$table->string('nomnavire', 200)->nullable();
            //$table->string('numvoyagem', 200)->nullable();
            //$table->string('numbietc', 200)->nullable();
            //$table->string('numconteneurm', 200)->nullable();
            //$table->string('numconnaissement', 200)->nullable();

            //$table->string('numlvi', 200)->nullable();
            //$table->string('numvehicule', 200)->nullable();
            //$table->string('numconteneurt', 200)->nullable();

            //$table->string('numvoyagef', 200)->nullable();
            //$table->string('numwagon', 200)->nullable();

            $table->date('dateembarque')->nullable();
            $table->string('lieuembarque',100)->nullable();
            $table->date('datedebarque')->nullable();
            $table->string('lieudebarque',100);

            $table->integer('totalpoids')->nullable();
            $table->integer('totalfrais')->nullable();
            $table->integer('totalenr')->nullable();
            $table->integer('totalpen')->nullable();
            $table->integer('totalglobal')->nullable();

            $table->string('observation',250)->nullable();

            $table->integer('valeurcaf_cfa')->nullable();
            $table->integer('valeurcaf_ext')->nullable();
            $table->string('valeurcaf_dev', 5)->nullable();
            //$table->integer('consoservice')->nullable();

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
        Schema::dropIfExists('amms');
    }
}
