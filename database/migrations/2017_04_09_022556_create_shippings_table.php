<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('shipping_types', function (Blueprint $table){
    		$table->increments('id');
    		$table->string('name');
    		$table->string('description')->default('');
    		$table->string('slug')->index();
    		$table->json('meta');
	    });

        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->json('meta')->nullable();

            $table->foreign('type_id')->references('id')->on('shipping_types');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('shippings');
        Schema::dropIfExists('shipping_types');
        Schema::enableForeignKeyConstraints();
    }
}
