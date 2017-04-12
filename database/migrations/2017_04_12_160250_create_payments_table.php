<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('payment_types', function (Blueprint $table){
    		$table->increments('id');
    		$table->text('name');
    		$table->text('slug');
    		$table->text('description');

    		$table->timestamps();
	    });


        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('order_id')->unsigned();

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
        Schema::dropIfExists('payments');
        Schema::dropIfExists('payment_types');
        Schema::enableForeignKeyConstraints();
    }
}
