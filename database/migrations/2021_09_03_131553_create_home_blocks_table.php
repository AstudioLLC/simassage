<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('imageSmall', 64)->nullable();
            $table->string('imageBig', 64)->nullable();
            $table->longText('short')->nullable();
            $table->longText('content')->nullable();
            $table->longText('children')->nullable();
            $table->longText('year')->nullable();
            $table->longText('donor')->nullable();
            $table->longText('labopratories')->nullable();
            $table->longText('community')->nullable();
            $table->longText('beggars')->nullable();
            $table->longText('count')->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_blocks');
    }
}
