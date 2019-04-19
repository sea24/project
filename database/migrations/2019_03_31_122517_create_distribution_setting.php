<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firsts', false, false)->comment('一级分销');
            $table->integer('secondary', false, false)->comment('一级分销');
            $table->integer('third', false, false)->comment('一级分销');
            $table->integer('integral', false, false)->comment('积分数量');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution_setting');
    }
}
