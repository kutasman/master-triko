<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('modificables', function (Blueprint $table){
        	$table->integer('modificator_id')->unsigned();
        	$table->morphs('modificable');
			$table->foreign('modificator_id')->references('id')->on('modificators')->onDelete('cascade');
        });

        Schema::create('mod_select_options', function(Blueprint $table){
			$table->increments('id');
			$table->integer('modificator_id')->unsigned();
			$table->string('name');
	        $table->float('value');
	        $table->timestamps();

	        $table->foreign('modificator_id')->references('id')->on('modificators')->onDelete('cascade');
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

        Schema::dropIfExists('modificators');
        Schema::dropIfExists('modificables');
        Schema::dropIfExists('mod_select_options');

        Schema::enableForeignKeyConstraints();
    }
}
