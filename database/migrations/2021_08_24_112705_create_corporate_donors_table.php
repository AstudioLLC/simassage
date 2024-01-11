<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_donors', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('image', 64)->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('corporate_donors');
    }
}
