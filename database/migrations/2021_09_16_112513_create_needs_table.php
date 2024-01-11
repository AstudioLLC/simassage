<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->index()->default(null);
            $table->json('title')->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedInteger('ordering')->default(0);
            $table->timestamps();

            $table->foreign('parent_id', 'fk_need_parent')
                ->references('id')
                ->on('needs')
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
        Schema::table('needs', function(Blueprint $table) {
            $table->dropForeign('fk_need_parent');
        });

        Schema::dropIfExists('needs');
    }
}
