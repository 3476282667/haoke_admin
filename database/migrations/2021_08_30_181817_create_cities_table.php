<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('城市名称');
            $table->string('code')->nullable()->comment('地区代码');
            $table->integer('type')->nullable()->comment('等级');
            $table->string('superior')->nullable()->comment('所属区域');
            $table->dateTime('createdAt')->comment('创建时间');
            $table->dateTime('updatedAt')->comment('上次修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
