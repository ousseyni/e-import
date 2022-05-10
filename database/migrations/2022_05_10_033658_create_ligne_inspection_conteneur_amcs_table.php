<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneInspectionConteneurAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_inspection_conteneur_amcs', function (Blueprint $table) {
            $table->id();

            $table->string('conteneurinspecte', 100)->nullable();
            $table->string('numeroplomb', 100)->nullable();

            $table->integer('idinspectionamc')->unsigned()->nullable();
            $table->foreign('idinspectionamc')->references('id')->on('inspection_amcs')->nullOnDelete();

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
        Schema::dropIfExists('ligne_inspection_conteneur_amcs');
    }
}
