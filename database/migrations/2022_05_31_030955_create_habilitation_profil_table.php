<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabilitationProfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilitation_profils', function (Blueprint $table) {
            $table->id();
            $table->integer('profils_id')->unsigned()->nullable();
            $table->integer('habilitation_id')->unsigned()->nullable();

            $table->foreign('profils_id')->references('id')->on('profils')->nullOnDelete();
            $table->foreign('habilitation_id')->references('id')->on('habilitations')->nullOnDelete();

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
        Schema::dropIfExists('habilitation_profils');
    }
}
