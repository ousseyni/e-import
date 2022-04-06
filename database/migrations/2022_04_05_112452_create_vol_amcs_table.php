<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vol_amcs', function (Blueprint $table) {
            $table->id();
            $table->string('numlta', 200);
            $table->string('cieaerien', 200);
            $table->string('numvol', 200);
            $table->integer('idamc')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idamc')->references('id')->on('amcs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vol_amcs');
    }
}
