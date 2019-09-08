<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCauHoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cau_hois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('tieu_de')->nullable();
            $table->text('noi_dung')->nullable();
            $table->integer('so_cau_tra_loi')->nullable()->default(0);
            $table->unsignedBigInteger('chu_de_id')->nullable();
            $table->foreign('chu_de_id')->references('id')->on('chu_des')->onDelete('cascade');
            $table->unsignedBigInteger('cau_tra_loi_tot_nhat_id')->nullable();
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
        Schema::dropIfExists('cau_hois');
    }
}
