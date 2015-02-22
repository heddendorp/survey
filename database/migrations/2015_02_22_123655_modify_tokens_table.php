<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('tokens');
        Schema::create('tokens', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('facility');
            $table->integer('group');
            $table->integer('survey_id');
            $table->integer('progress');
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
		Schema::dropIfExists('tokens');
	}

}
