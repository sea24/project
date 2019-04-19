<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollisionSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collision_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('impact1', 11, 2)->comment('碰撞1');
            $table->decimal('impact2', 11, 2)->comment('碰撞2');
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
        Schema::dropIfExists('collision_setting');
    }
}
