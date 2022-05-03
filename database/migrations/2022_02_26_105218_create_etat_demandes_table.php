<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtatDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etat_demandes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle_dgcc',200);
            $table->string('libelle_user',200);
            $table->integer('etat_actuel')->unsigned();
            $table->string('etat_suivant', 200);
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
        Schema::dropIfExists('etat_demandes');
    }
}
