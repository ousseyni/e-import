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
            $table->string('raisonsocial');
            $table->string('rccm');
            $table->string('bp');
            $table->string('tel');
            $table->string('email');
            $table->string('numagrement');
            $table->string('numcartecomm');
            $table->integer('typecontribuableid')->unsigned();
            $table->string('slug', 100);
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
