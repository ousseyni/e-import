<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneInspectionAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_inspection_amcs', function (Blueprint $table) {
            $table->id();

            $table->string('marque', 100);
            $table->string('nom', 100);
            $table->string('numerolot', 100);
            $table->string('paysorig', 50);
            $table->string('fournisseur', 200);
            $table->string('fabricant', 200);
            $table->string('ingredients');
            $table->integer('qtenet');
            $table->string('durabilite');
            $table->string('modeemploi');
            $table->string('allegation');

            $table->date('datefact');
            $table->integer('poids');

            $table->boolean('possede2aire');
            $table->string('observation2aire');
            $table->boolean('etat2aire');

            $table->boolean('possede1aire');
            $table->string('observation1aire');
            $table->boolean('etat1aire');

            $table->string('autreobservation');

            $table->integer('idinspectionamc')->unsigned()->nullable();
            $table->integer('idproduitamc')->unsigned()->nullable();

            $table->foreign('idinspectionamc')->references('id')->on('inspection_amcs')->nullOnDelete();
            $table->foreign('idproduitamc')->references('id')->on('produit_amcs')->nullOnDelete();

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
        Schema::dropIfExists('ligne_inspection_amcs');
    }
}
