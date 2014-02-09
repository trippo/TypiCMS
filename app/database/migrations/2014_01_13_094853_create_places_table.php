<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('places', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->tinyInteger('status');
			$table->string('title');
			$table->string('slug')->unique()->nullable();
			$table->string('address')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('website')->nullable();
			$table->string('image')->nullable();
			$table->string('logo')->nullable();
			$table->string('latitude', 30)->nullable();
			$table->string('longitude', 30)->nullable();
			$table->timestamps();
		});

		Schema::create('place_translations', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id')->unsigned();
			$table->integer('place_id')->unsigned();

			$table->string('locale')->index();

			$table->text('info')->nullable();

			$table->timestamps();

			$table->unique(array('place_id', 'locale'));
			$table->foreign('place_id')->references('id')->on('places');
			
		});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('place_translations', function($table)
		{
			$table->dropForeign('place_translations_place_id_foreign');
		});

		Schema::drop('places');
		Schema::drop('place_translations');
	}

}
