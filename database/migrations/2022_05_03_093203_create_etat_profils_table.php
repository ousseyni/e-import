<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtatProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etat_profils', function (Blueprint $table) {
            $table->id();

            $table->integer('idprofil')->unsigned()->nullable();
            $table->integer('etat')->unsigned();

            $table->foreign('idprofil')->references('id')->on('profils')->nullOnDelete();
            $table->foreign('etat')->references('id')->on('etat_demandes')->nullOnDelete();
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
        Schema::dropIfExists('etat_profils');
    }
}
