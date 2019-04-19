<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, false)->comment('用户Id');
            $table->integer('shop_id', false, false)->nullable()->comment('挂售Id');
            $table->integer('province', false, false)->comment('省');
            $table->integer('city', false, false)->comment('市');
            $table->integer('area', false, false)->comment('区');
            $table->string('address')->comment('详细地址');
            $table->string('express')->comment('快递');
            $table->string('express_code')->comment('快递单号');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('real_name')->comment('真实姓名');
            $table->string('mobile')->comment('手机号');
            $table->integer('type', false, false)->comment('订单类型，0普通专区,1活动专区，2团购区，3寄售专区');

            $table->decimal('price', 11, 2)->comment('商品价格');
            $table->integer('payment_type', false, false)->comment('付款类型');
            $table->decimal('group_buy', 11, 2)->nullable()->comment('团购卷');
            $table->integer('pay_status', false, false)->comment('付款状态');
            $table->string('order_sn')->comment('订单号');
            $table->string('shop_ordersn')->nullable()->comment('订单号');
            $table->integer('status', false, false)->default(0)->comment('订单状态');
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
        Schema::dropIfExists('_orders');
    }
}
