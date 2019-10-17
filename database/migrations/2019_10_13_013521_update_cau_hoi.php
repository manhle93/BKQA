<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCauHoi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cau_hois', function ($table) {
            $table->dropColumn('cau_tra_loi_tot_nhat_id');
        });
        Schema::table('cau_hois', function (Blueprint $table) {
            $table->boolean('trang_thai')->default(false);
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
