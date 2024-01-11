<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->longText('title')->nullable();
            $table->string('imageSmall', 64)->nullable();
            $table->string('imageBig', 64)->nullable();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('cost')->nullable()->default(null);
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->longText('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->longText('seo_keywords')->nullable();
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
        Schema::dropIfExists('gifts');
    }
}
