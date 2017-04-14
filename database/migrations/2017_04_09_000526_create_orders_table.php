<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    	Schema::create('order_statuses', function (Blueprint $table){
    		$table->increments('id');
    		$table->string('name');
    		$table->string('description')->default('');
    		$table->string('slug')->index();

    		$table->timestamps();
	    });
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

	        $table->string('first_name');
	        $table->string('last_name')->default('');
	        $table->string('email');
	        $table->string('phone');
	        $table->string('comment')->default('');
	        $table->integer('status_id')->unsigned()->default();

	        $table->integer('cart_id')->unsigned();

	        $table->foreign('status_id')->references('id')->on('order_statuses');


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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_statuses');
        Schema::enableForeignKeyConstraints();
    }
}
