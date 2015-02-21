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
		Schema::create('surveys', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('customer_id');
            $table->text('questions_json');
            $table->text('members_json');
            $table->text('facilities_json');
            $table->text('groups_json');
            $table->string('questionnaire');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
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
