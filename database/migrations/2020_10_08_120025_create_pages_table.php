<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->index()->default(null);
            $table->string('url')->nullable();
            $table->json('title')->nullable();
            $table->string('icon', 64)->nullable();
            $table->string('image', 64)->nullable();
            $table->boolean('show_image')->default(1);
            $table->boolean('to_top')->default(1);
            $table->boolean('to_menu')->default(1);
            $table->boolean('to_footer')->default(1);
            $table->json('content')->nullable();
            $table->json('title_content')->nullable();
            $table->string('static', 64)->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id', 'fk_page_parent')
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
        Schema::dropIfExists('pages');
    }
}
