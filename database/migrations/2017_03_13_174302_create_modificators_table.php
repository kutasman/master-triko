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
	        $table->string('description');
	        $table->string('type');
	        $table->integer('product_id')->unsigned();

	        $table->foreign('product_id')->references('id')->on('products');
	        $table->timestamps();
        });

        Schema::create('mod_options', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name');
        	$table->string('value');

        	$table->integer('modificator_id')->unsigned();

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
        Schema::dropIfExists('modificators');
        Schema::dropIfExists('mod_options');
        Schema::enableForeignKeyConstraints();
    }
}
