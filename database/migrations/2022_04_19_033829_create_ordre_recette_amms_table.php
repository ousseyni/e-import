<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdreRecetteAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordre_recette_amms', function (Blueprint $table) {
            $table->id();
            $table->integer('exercice')->unsigned();
            $table->date('date_emission');
            $table->boolean('est_paye')->default(false);
            $table->date('date_paye')->nullable();
            $table->string('quittance', 150)->unique();
            $table->integer('idamm')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idamm')->references('id')->on('amms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordre_recette_amms');
    }
}
