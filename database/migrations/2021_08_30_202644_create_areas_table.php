<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city')->nullable()->comment('城市代号');
            $table->string('city_name')->nullable()->comment('城市名称');
            $table->string('area')->nullable()->comment('区域代号');
            $table->string('area_name')->nullable()->comment('区域名称');
            $table->string('street')->nullable()->comment('街道代号');
            $table->string('street_name')->nullable()->comment('街道名称');
            $table->string('community')->nullable()->comment('小区代号');
            $table->string('community_name')->nullable()->comment('小区名称');
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
        Schema::dropIfExists('areas');
    }
}
