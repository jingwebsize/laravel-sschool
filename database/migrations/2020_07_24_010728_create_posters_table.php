<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('title',500)->comment('标题')->default('')->nullable();
            $table->text('abstract')->comment('摘要')->nullable();
            $table->text('content')->comment('内容')->nullable();
            $table->string('imgurl',500)->comment('海报')->default('')->nullable();
            $table->string('audiourl',500)->comment('音频')->default('')->nullable();
            $table->string('videourl',500)->comment('视频')->default('')->nullable();
            $table->string('userid',50)->comment('作者ID');
            $table->string('username',50)->comment('作者名')->default('')->nullable();
            $table->tinyInteger('isvideo')->comment('视频tag')->default(0)->nullable();
            $table->tinyInteger('flag')->comment('生效情况')->default(0)->nullable();
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
        Schema::dropIfExists('posters');
    }
}
