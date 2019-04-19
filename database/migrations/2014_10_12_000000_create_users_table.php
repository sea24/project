<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile');
            $table->string('password');
            $table->string('card')->comment('身份证号');
            $table->decimal('money_integral', 11, 2)->comment('现金积分');
            $table->decimal('income_integral', 11, 2)->comment('收益积分');
            $table->decimal('group_buy', 11, 2)->comment('团购卷');
            $table->decimal('activity_integral', 11, 2)->comment('活动积分');
            $table->decimal('performance', 11, 2)->comment('业绩');
            $table->string('avatr_img', 100)
                ->default('/uploads/images/header.jpg')
                ->comment('头像');
            $table->string('sex', 1)->default(0)->comment('性别');
            $table->string('bankname', 100)->comment('银行卡名字');
            $table->string('bankaddress', 100)->comment('银行卡地址');
            $table->string('banknum', 30)->comment('银行号码');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
