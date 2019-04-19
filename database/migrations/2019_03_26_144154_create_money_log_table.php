<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id',false,false)->comment('用户id');
            $table->decimal('money_integral',11,2)->comment('提现金额');
            $table->integer('poundage',false,false)->comment('手续费');
            $table->decimal('actual_money',11,2)->comment('实际金额');
            $table->string('bankname',255,false)->comment('银行名称');
            $table->string('bankadress',255,false)->comment('银行地址');
            $table->string('banknum',255,false)->comment('银行卡号');
            $table->integer('status', false, false)->default(0)->comment('0未审核');
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
        Schema::dropIfExists('money_log');
    }
}
