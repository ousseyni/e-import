<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_activites', function (Blueprint $table) {
            $table->id();
            $table->integer('activiteid')->unsigned()->nullable();
            $table->string('code',10);
            $table->string('libelle',200);
            $table->string('slug', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('activiteid')->references('id')->on('activites')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_activites');
    }
}
