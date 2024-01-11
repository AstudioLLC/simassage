<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->string('sponsor_id', 100)->unique()->default(null);
            $table->boolean('donor_type')->nullable()->default(null);
            $table->longText('date_of_birth')->nullable();
            $table->boolean('recurring_payment')->nullable()->default(null);
            $table->boolean('is_send_email')->nullable()->default(null);
            $table->string('children_age_beetwen', 225)->nullable()->default(null);
            $table->unsignedBigInteger('children_gender')->nullable()->default(null);
            $table->unsignedBigInteger('children_region')->nullable()->default(null);
            $table->unsignedBigInteger('children_program_approach')->nullable()->default(null);
            $table->boolean('want_recive_letters')->nullable()->default(null);

            $table->foreign('user_id', 'fk_user_options')
                ->references('id')
                ->on('users')
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
        Schema::table('user_options', function (Blueprint $table) {
            $table->dropForeign('fk_user_options');
        });

        Schema::dropIfExists('user_options');
    }
}
