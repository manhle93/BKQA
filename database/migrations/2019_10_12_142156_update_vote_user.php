<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVoteUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vote_user_cautralois', function (Blueprint $table) {
            $table->unsignedBigInteger('cau_hoi_id')->nullable();
            $table->foreign('cau_hoi_id')->references('id')->on('cau_hois');

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
