<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChuDesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chu_des', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('tieu_de')->nullable();
            $table->string('mo_ta')->nullable();
            $table->text('anh_dai_dien')->nullable();
            $table->integer('so_cau_hoi')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('chu_des');
    }
}
