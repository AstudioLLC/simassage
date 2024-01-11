<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->text('title')->nullable();
            $table->string('image', 64)->nullable();
            $table->longText('content')->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('page_id', 'fk_page')
                ->references('id')
                ->on('pages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign('fk_page');
        });

        Schema::dropIfExists('faqs');
    }
}
