<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolAmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vol_amms', function (Blueprint $table) {
            $table->id();
            $table->string('numlta', 200);
            $table->string('cieaerien', 200);
            $table->string('numvol', 200);
            $table->integer('idamm')->unsigned()->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('vol_amms');
    }
}
