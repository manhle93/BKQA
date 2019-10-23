<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBaoCaoViPham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bao_cao_vi_phams', function (Blueprint $table) {
            $table->unsignedBigInteger('cau_hoi_bao_cao_id')->nullable();
            $table->foreign('cau_hoi_bao_cao_id')->references('id')->on('cau_hois')->onDelete('cascade');
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
        //
    }
}
