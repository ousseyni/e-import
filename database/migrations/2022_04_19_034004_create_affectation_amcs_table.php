<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectationAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affectation_amcs', function (Blueprint $table) {
            $table->id();
            $table->boolean('est_traite')->nullable();
            $table->integer('idamc')->unsigned()->nullable();
            $table->integer('iduser')->unsigned()->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
            $table->foreign('idamc')->references('id')->on('amcs')->nullOnDelete();
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
        Schema::dropIfExists('affectation_amcs');
    }
}
