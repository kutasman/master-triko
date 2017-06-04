<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mod_rules', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('product_id')->unsigned();

            $table->integer('toggle_id')->unsigned();

            $table->integer('toggle_option_id')->unsigned();

            $table->integer('target_id')->unsigned();

            $table->string('action');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->foreign('toggle_id')->references('id')->on('modificators')->onDelete('cascade');

            $table->foreign('toggle_option_id')->references('id')->on('mod_options')->onDelete('cascade');

            $table->foreign('target_id')->references('id')->on('modificators')->onDelete('cascade');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('mod_rules');
        Schema::enableForeignKeyConstraints();
    }
}
