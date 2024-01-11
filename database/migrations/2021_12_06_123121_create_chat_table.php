<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sponsor_id')->index();
            $table->unsignedBigInteger('children_id')->index();
            $table->string('file', 1000)->nullable();
            $table->longText('message')->nullable();
            $table->boolean('message_from')->nullable()->default(null)->comment('0 - From Child, 1 - From Sponsor');
            $table->boolean('is_read')->nullable()->default(null)->comment('0 - Message not read, 1 - Message read');
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
        Schema::dropIfExists('chat');
    }
}
