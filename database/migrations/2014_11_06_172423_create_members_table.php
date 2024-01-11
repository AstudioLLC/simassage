<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->string('member');
                $table->string('imageBig', 64)->nullable();
                $table->text('short')->nullable();
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
        Schema::dropIfExists('members');
    }
}
