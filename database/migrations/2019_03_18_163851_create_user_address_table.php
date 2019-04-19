<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, false)->comment('用户ID');
            $table->integer('province', false, false)->comment('省');
            $table->integer('city', false, false)->comment('市');
            $table->integer('area', false, false)->comment('区');
            $table->integer('status', false, false)->default(0)->comment('默认');
            $table->string('address')->comment('详细地址');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('real_name')->comment('真实姓名');
            $table->string('mobile')->comment('手机号');
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
        Schema::dropIfExists('user_address');
    }
}
