<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('type')->default(\App\Models\IncomeLog::TYPE_CONVERSION);
            $table->string('calculation')->default(\App\Models\IncomeLog::CALCULATION_ADD);

            $table->decimal('price', 11, 2);
            $table->decimal('money_integral', 11, 2);
            $table->decimal('income_integral', 11, 2);
            $table->decimal('group_buy', 11, 2);


            $table->decimal('original_money_integral', 11, 2);
            $table->decimal('original_income_integral', 11, 2);
            $table->decimal('original_group_buy', 11, 2);

            $table->text('description')->nullable();
//            $table->unsignedBigInteger('give_id')->default(0);
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
        Schema::dropIfExists('income_logs');
    }
}
