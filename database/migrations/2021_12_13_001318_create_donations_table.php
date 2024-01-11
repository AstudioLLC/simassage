<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->string('mdorder')->nullable();
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('fundraiser_id')->nullable()->index()->default(null);
            $table->unsignedBigInteger('gift_id')->nullable()->index()->default(null);
            $table->boolean('is_binding')->default(0);
            $table->string('bindingId')->nullable();
            $table->unsignedBigInteger('sponsor_id')->nullable()->index()->default(null);
            $table->unsignedBigInteger('children_id')->nullable()->index()->default(null);
            $table->unsignedInteger('amount')->default(0);
            $table->string('email')->nullable();
            $table->string('fullname')->nullable();
            $table->enum('card_type', ['master', 'visa', 'arca'])->default('arca');
            $table->longText('message')->nullable();
            $table->longText('message_admin')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
