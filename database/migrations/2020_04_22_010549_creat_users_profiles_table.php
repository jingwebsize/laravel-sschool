<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid',50)->comment('用户ID');
            $table->string('year',4)->comment('年份')->default('')->nullable();
            $table->string('name',200)->comment('姓名')->default('')->nullable();
            $table->string('school',500)->comment('所属院校')->default('')->nullable();
            $table->string('tutor',200)->comment('导师姓名')->default('')->nullable();
            $table->string('major',300)->comment('专业')->default('')->nullable();
            $table->tinyInteger('grade')->comment('年级')->default(0)->nullable();
            $table->tinyInteger('sex')->comment('性别')->default(0)->nullable();
            $table->tinyInteger('type')->comment('身份')->default(0)->nullable();
            $table->Integer('idcard')->comment('身份证号')->default(0)->nullable();
            $table->string('birth',50)->comment('出生日期')->default('')->nullable();
            $table->string('tel',50)->comment('手机')->nullable()->default('');
            $table->string('email',100)->comment('邮箱')->nullable()->default('');
            $table->tinyInteger('house')->comment('预定住宿')->default(0)->nullable();
            $table->string('addr',300)->comment('通讯地址')->default('')->nullable();
            $table->tinyInteger('tcolor')->comment('T恤颜色')->default(0)->nullable();
            $table->tinyInteger('tsize')->comment('T恤尺码')->default(0)->nullable();
            $table->string('url',150)->comment('付款凭证')->default('')->nullable();
            $table->longText('reason')->comment('申请理由')->nullable();
            $table->tinyInteger('display')->comment('报名状态')->default(0)->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
