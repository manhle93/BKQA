<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCauTraLoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cau_tra_lois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('noi_dung')->nullable();
            $table->integer('votes')->nullable()->default(0);
            $table->unsignedBigInteger('cau_hoi_id')->nullable();
            $table->foreign('cau_hoi_id')->references('id')->on('cau_hois')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cau_tra_lois');
    }
}
