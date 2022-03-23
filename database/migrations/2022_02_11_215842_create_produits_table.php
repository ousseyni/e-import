<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->integer('categorie_produit_id')->unsigned()->nullable();
            $table->string('code',10);
            $table->string('libelle',200);
            $table->integer('montant');
            $table->enum('type', ['AMM', 'AMC']);
            $table->string('slug', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('categorie_produit_id')->references('id')->on('categorie_produits')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
