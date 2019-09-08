<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheCauHoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_cau_hois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('cau_hoi_id')->nullable();
            $table->foreign('cau_hoi_id')->references('id')->on('cau_hois');
            $table->unsignedBigInteger('the_id')->nullable();
            $table->foreign('the_id')->references('id')->on('thes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('the_cau_hois');
    }
}
