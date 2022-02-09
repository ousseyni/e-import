<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_comptes', function (Blueprint $table) {
            $table->id();
            $table->string('nif', 10);
            $table->string('raisonsociale', 150);
            $table->integer('typecontribuableid')->unsigned()->nullable();
            $table->string('tel', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('pj')->nullable();
            $table->boolean('etat')->nullable();
            $table->string('slug', 100);
            $table->timestamps();
            $table->foreign('typecontribuableid')->references('id')->on('type_contribuables')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_comptes');
    }
}
