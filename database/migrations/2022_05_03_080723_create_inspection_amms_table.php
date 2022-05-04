<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_amms', function (Blueprint $table) {
            $table->id();

            $table->dateTime('dateinspection');

            $table->enum('conditiontransport', ['Ambiante', 'Refrigéré', 'Surgelé']);
            $table->string('poinentree', 150)->nullable();
            $table->string('lieuinspection', 150)->nullable();

            $table->string('conteneurinspecte', 100)->nullable();
            $table->string('numeroplomb', 100)->nullable();
            $table->string('natureproduits', 100)->nullable();
            $table->integer('totalqte')->nullable();
            $table->integer('idamm')->unsigned()->nullable();

            $table->boolean('conclusion')->nullable();
            $table->string('observation')->nullable();

            $table->integer('iduser')->unsigned()->nullable();
            $table->integer('idcontribuable')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('users')->nullOnDelete();
            $table->foreign('idcontribuable')->references('id')->on('contribuables')->nullOnDelete();
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
        Schema::dropIfExists('inspection_amms');
    }
}
