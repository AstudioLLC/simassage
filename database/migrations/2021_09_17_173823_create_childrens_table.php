<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->string('child_id', 100)->unique()->default(null);
            $table->unsignedBigInteger('region_id')->nullable()->index()->default(null);
            $table->unsignedBigInteger('sponsor_id')->nullable()->index()->default(null);
            $table->longText('title')->nullable();
            $table->string('image', 64)->nullable();
            $table->longText('content')->nullable();
            $table->longText('date_of_birth')->nullable();
            $table->boolean('gender')->nullable()->default(null)->comment('0 - Male, 1 - Female');
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
        Schema::dropIfExists('childrens');
    }
}
