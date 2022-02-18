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
            $table->integer('categorieid')->unsigned()->nullable();
            $table->string('code',10);
            $table->string('libelle',200);
            $table->integer('montant');
            $table->string('slug', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('categorieid')->references('id')->on('categorie_produits')->nullOnDelete();

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
