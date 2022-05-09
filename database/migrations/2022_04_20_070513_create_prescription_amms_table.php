<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_amms', function (Blueprint $table) {
            $table->id();
            $table->date('dateprpt');
            $table->string('value', 100)->nullable();
            $table->string('comments')->nullable();
            $table->integer('iduser')->unsigned()->nullable();
            $table->integer('idamm')->unsigned()->nullable();
            $table->integer('idprescription')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('iduser')->references('id')->on('users')->nullOnDelete();
            $table->foreign('idamm')->references('id')->on('amms')->nullOnDelete();
            $table->foreign('idprescription')->references('id')->on('prescriptions')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_amms');
    }
}
