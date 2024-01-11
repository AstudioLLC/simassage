<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteeringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteering', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->string('email')->unique();
            $table->longText('surname');
            $table->longText('age_group');
            $table->string('phone');
            $table->string('file');
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('volunteering');
    }
}
