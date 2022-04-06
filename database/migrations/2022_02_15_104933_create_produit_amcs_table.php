<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_amcs', function (Blueprint $table) {
            $table->id();
            $table->string('numfact', 20);
            $table->date('datefact');
            $table->string('fournisseur', 200);
            $table->string('marque', 100);
            $table->string('paysorig', 50);
            $table->integer('poids')->nullable();
            $table->integer('total')->nullable();
            $table->integer('idamc')->unsigned()->nullable();
            $table->integer('idproduit')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idamc')->references('id')->on('amcs')->nullOnDelete();
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
        Schema::dropIfExists('produit_amcs');
    }
}
