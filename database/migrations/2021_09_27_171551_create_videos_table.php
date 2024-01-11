<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('type')->nullable()->default(0)->comment('0 - Youtube, 1 - MP4');
            $table->string('video');
            $table->integer('key')->unsigned()->nullable();
            $table->string('name', 100)->nullable();
            $table->string('link', 100)->nullable();
            $table->longText('title')->nullable();
            $table->unsignedInteger('ordering')->default(0);
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
        Schema::dropIfExists('videos');
    }
}
