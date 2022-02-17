<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContribuablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribuables', function (Blueprint $table) {
            $table->id();
            $table->string('nif');
            $table->integer('typecontribuableid')->unsigned()->nullable();
            $table->string('raisonsociale', 200);
            $table->string('siegesocial', 150)->nullable();
            $table->string('bp', 150)->nullable();
            $table->string('tel', 50)->nullable();
            $table->string('rccm', 100)->nullable();
            $table->string('numagrement', 100)->nullable();
            $table->string('numcartecomm', 100)->nullable();
            $table->string('nomprenom', 150)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('pj', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('contribuables');
    }
}
