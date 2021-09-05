<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('carouselMap')->nullable()->comment('房屋图片');
            $table->string('title')->nullable()->comment('房屋名称');
            $table->string('description')->nullable()->comment('房屋介绍');
            $table->tinyInteger('entire')->default('1')->nullable()->comment('整租 / 合租');
            $table->integer('price_num')->nullable()->comment('房屋价格');
            $table->string('room_type_name')->nullable()->comment('几室');
            $table->string('community')->nullable()->comment('所在小区');
            $table->string('supporting')->default('')->comment('房屋配置');
            $table->string('oriented_name')->nullable()->comment('朝向');
            $table->string('floor')->nullable()->comment('楼层');
            $table->string('coord')->nullable()->comment('经纬度');
            $table->string('area_name')->nullable()->comment('地区名称');
            $table->string('tags')->nullable()->comment('房屋亮点');
            $table->integer('size')->nullable()->comment('房屋面积');
            $table->integer('user_id')->nullable()->comment('发布用户');
            $table->dateTime('createdAt')->comment('创建时间');
            $table->dateTime('updatedAt')->comment('上次修改时间');
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
        Schema::dropIfExists('houses');
    }
}
