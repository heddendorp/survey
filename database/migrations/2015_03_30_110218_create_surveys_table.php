<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surveys', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->boolean('open')->default(false);
            $table->boolean('started')->default(false);
            $table->json('questions');
            $table->json('groups');
            $table->text('welcome_mail')->nullable();
            $table->text('remember_mail')->nullable();
            $table->text('finish_mail')->nullable();
            $table->string('name');
            $table->date('ends');
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
		Schema::drop('surveys');
	}

}
