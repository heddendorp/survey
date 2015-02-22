<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('surveys');
        Schema::create('surveys', function(Blueprint $table)
        {
            $table->increments('id');
            $table->boolean('open')->default(true);
            $table->boolean('welcomed')->default(false);
            $table->integer('customer_id');
            $table->json('questions');
            $table->json('facilities');
            $table->json('groups');
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
        Schema::dropIfExists('surveys');
    }

}
