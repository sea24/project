<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersauxiliaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersauxiliarys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id', false, false)->comment('订单id');
            $table->integer('pid', false, false)->comment('商品id');
            $table->integer('num', false, false)->comment('数量');
            $table->decimal('group_buy', 11, 2)->nullable()->comment('团购卷');
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
        Schema::dropIfExists('ordersauxiliary');
    }
}
