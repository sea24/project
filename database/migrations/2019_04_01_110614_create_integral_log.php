<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegralLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integral_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, false)->comment('用户Id');
            $table->integer('type', false, false)->comment('积分来源');
            $table->integer('operation', false, false)->comment('1是加积分2是减少积分');
            $table->integer('difference', false, false)->comment('积分类型和业绩');
            $table->decimal('price', 11, 2)->comment('积分数量');
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
        Schema::dropIfExists('integral_log');
    }
}
