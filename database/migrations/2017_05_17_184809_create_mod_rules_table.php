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

            $table->integer('modificator_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->integer('target_id')->unsigned();
            $table->string('action');

            $table->foreign('modificator_id')->references('id')->on('modificators')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('mod_options')->onDelete('cascade');
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
