<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, false)->comment('用户ID');
            $table->text('first_level')->nullable()->comment('一级');
            $table->decimal('performance', 11, 2)->comment('业绩');
            $table->integer('counts', false, false)->default(0)->comment('碰撞次数');
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
        Schema::dropIfExists('collisions');
    }
}
