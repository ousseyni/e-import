<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectationAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affectation_amms', function (Blueprint $table) {
            $table->id();
            $table->boolean('est_traite')->nullable();
            $table->integer('idamm')->unsigned()->nullable();
            $table->integer('iduser')->unsigned()->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
            $table->foreign('idamm')->references('id')->on('amms')->nullOnDelete();
            $table->foreign('iduser')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affectation_amms');
    }
}
