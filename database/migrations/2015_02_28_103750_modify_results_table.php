<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('results');
        Schema::create('results', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('survey_id');
            $table->integer('facility');
            $table->integer('group');
            $table->string('facility_name');
            $table->string('group_name');
            $table->json('data')->nullable();
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
        Schema::dropIfExists('results');
	}

}
