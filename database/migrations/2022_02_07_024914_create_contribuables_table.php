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
            $table->string('raisonsociale');
            $table->string('siegesocial')->nullable();
            $table->string('bp')->nullable();
            $table->string('tel')->nullable();
            $table->string('rccm')->nullable();
            $table->string('numagrement')->nullable();
            $table->string('numcartecomm')->nullable();
            $table->string('nomprenom')->nullable();
            $table->string('email')->nullable();
            $table->binary('pj')->nullable();
            $table->string('slug', 100)->nullable();
            $table->timestamps();
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
