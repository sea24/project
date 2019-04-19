<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name')->comment('商品名称');
            $table->string('title')->comment('商品标题');
            $table->integer('category_id', false, false)->comment('商品分类');
            $table->integer('stock', false, false)->comment('商品库存');
            $table->text('groupimg')->comment('商品组图');
            $table->text('content')->comment('商品详情');
            $table->decimal('price', 11, 2)->comment('商品价格');
            $table->decimal('market_price', 11, 2)->comment('市场价格');
            $table->decimal('group_buy', 11, 2)->nullable()->comment('团购卷');
            $table->timestamp('start_at', 0)->nullable();
            $table->timestamp('end_at', 0)->nullable();
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
        Schema::dropIfExists('product');
    }
}
