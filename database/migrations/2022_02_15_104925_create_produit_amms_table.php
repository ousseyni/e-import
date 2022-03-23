<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_amms', function (Blueprint $table) {
            $table->id();
            $table->string('numfact', 20);
            $table->date('datefact');
            $table->string('fournisseur', 200);
            $table->string('marque', 100);
            $table->string('paysorig', 50);
            $table->integer('poids')->nullable();
            $table->integer('total')->nullable();
            $table->integer('idamm')->unsigned()->nullable();
            $table->integer('idproduit')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idamm')->references('id')->on('amms')->nullOnDelete();
            $table->foreign('idproduit')->references('id')->on('produits')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_amms');
    }
}
