<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keys', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('result_id')->unsigned();
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->integer('progress')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('token');
            $table->boolean('finished')->default(false);
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
		Schema::drop('keys');
	}

}
