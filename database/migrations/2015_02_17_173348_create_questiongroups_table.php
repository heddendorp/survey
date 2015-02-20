<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestiongroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questiongroups', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('section_id');
            $table->integer('type');
            $table->integer(('order'));
            $table->integer('condition')->nullable();
            $table->string('heading');
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
		Schema::drop('questiongroups');
	}

}
