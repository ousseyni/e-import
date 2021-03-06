<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneInspectionAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_inspection_amms', function (Blueprint $table) {
            $table->id();

            $table->string('marque', 100)->nullable();
            $table->string('nom', 100)->nullable();
            $table->string('numerolot', 100)->nullable();
            $table->string('paysorig', 50)->nullable();
            $table->string('fournisseur', 200)->nullable();
            $table->string('fabricant', 200)->nullable();
            $table->string('ingredients')->nullable();
            $table->integer('qtenet')->nullable();
            $table->date('durabilite')->nullable();
            $table->string('modeemploi')->nullable();
            $table->string('allegation')->nullable();

            $table->boolean('possede2aire')->nullable();
            $table->string('observation2aire')->nullable();
            $table->boolean('etat2aire')->nullable();

            $table->boolean('possede1aire')->nullable();
            $table->string('observation1aire')->nullable();
            $table->boolean('etat1aire')->nullable();

            $table->string('autreobservation')->nullable();

            $table->integer('idinspectionamm')->unsigned()->nullable();
            $table->integer('idproduit')->unsigned()->nullable();

            $table->foreign('idinspectionamm')->references('id')->on('inspection_amms')->nullOnDelete();
            $table->foreign('idproduit')->references('id')->on('produits')->nullOnDelete();

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
        Schema::dropIfExists('ligne_inspection_amms');
    }
}
