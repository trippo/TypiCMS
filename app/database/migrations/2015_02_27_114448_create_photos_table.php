<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('folder_id')->unsigned()->default(0);
            $table->integer('product_id')->unsigned()->default(0);

            $table->integer('user_id')->unsigned()->default(0);

            $table->enum('type', array('a', 'v', 'd', 'i', 'o'))->nullable();
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->string('extension', 8)->nullable();
            $table->string('mimetype', 100)->nullable();
            $table->integer('width')->unsigned()->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('filesize')->unsigned()->nullable();
            $table->integer('download_count')->unsigned()->default(0);

            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();

        });

        Schema::create('photo_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('photo_id')->unsigned();

            $table->string('locale')->index();

            $table->text('description');
            $table->string('alt_attribute');
            $table->string('keywords');

            $table->timestamps();

            $table->unique(array('photo_id', 'locale'));
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photo_translations');
        Schema::drop('photos');
	}

}
