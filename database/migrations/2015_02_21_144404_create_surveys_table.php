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
            $table->boolean('open')->default(true);
            $table->integer('customer_id');
            $table->json('questions');
            $table->json('members');
            $table->json('facilities');
            $table->text('groups');
            $table->text('welcome_mail')->nullable();
            $table->text('remember_mail')->nullable();
            $table->text('finish_mail')->nullable();
            $table->string('questionnaire');
            $table->string('name');
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
