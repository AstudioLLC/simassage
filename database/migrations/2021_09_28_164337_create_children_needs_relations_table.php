<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenNeedsRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_needs_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('children_id')->index();
            $table->unsignedBigInteger('needs_id')->index();

            $table->foreign('children_id', 'fk_children_relation')
                ->references('id')
                ->on('childrens')
                ->onDelete('cascade');

            $table->foreign('needs_id', 'fk_needs_relation')
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
        Schema::table('children_needs_relations', function (Blueprint $table) {
            $table->dropForeign('fk_children_relation');
            $table->dropForeign('fk_needs_relation');
        });

        Schema::dropIfExists('children_needs_relations');
    }
}
