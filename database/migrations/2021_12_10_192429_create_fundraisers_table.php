<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundraisers', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('child_id')->nullable()->index()->default(null);
            $table->unsignedInteger('cost')->default(0);
            $table->unsignedInteger('collected')->default(0);
            $table->boolean('unlimit')->default(1);
            $table->longText('title');
            $table->string('imageSmall', 64)->nullable();
            $table->string('imageBig', 64)->nullable();
            $table->longText('short')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
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
        Schema::dropIfExists('fundraisers');
    }
}
