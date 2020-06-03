<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid',50)->comment('用户ID');
            $table->string('year',4)->comment('年份')->default('')->nullable();
            $table->string('name',200)->comment('姓名')->default('')->nullable();
            $table->tinyInteger('house')->comment('预定住宿')->default(0)->nullable();
            $table->tinyInteger('tcolor')->comment('T恤颜色')->default(0)->nullable();
            $table->tinyInteger('tsize')->comment('T恤尺码')->default(0)->nullable();
            $table->string('url',150)->comment('付款凭证')->default('')->nullable();
            $table->string('remark',500)->comment('备注')->default('')->nullable();
            $table->string('file',150)->comment('总结文件')->default('')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
