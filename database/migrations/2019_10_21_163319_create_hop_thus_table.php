<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopThusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hop_thus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_gui_id')->nullable();
            $table->foreign('user_gui_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_nhan_id')->nullable();
            $table->foreign('user_nhan_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('noi_dung')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hop_thus');
    }
}
