<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('small_title')->nullable();
            $table->json('content')->nullable();
            $table->string('count', 50)->nullable();
            $table->string('icon', 64)->nullable();
            $table->string('image', 64)->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->string('url')->nullable();
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
        Schema::dropIfExists('blocks');
    }
}
