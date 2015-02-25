<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('answers');
        Schema::create('answers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('survey_id');
            $table->integer('token_id');
            $table->integer('question');
            $table->integer('answer');
            $table->integer('type');
            $table->text('text')->nullable();
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
		Schema::table('answers', function(Blueprint $table)
		{
            Schema::dropIfExists('answers');
		});
	}

}
