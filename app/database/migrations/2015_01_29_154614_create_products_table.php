<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('sku')->nullable();
			$table->integer('partner_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
			$table->decimal('price',14,4)->unsigned();
			$table->decimal('discount',14,4)->unsigned()->nullable()->default(null);
			$table->decimal('weight',10,4)->unsigned()->nullable()->default(null);
			$table->smallInteger('position')->unsigned()->default(0);
			$table->text('image')->nullable();
			$table->text('images')->nullable();
			$table->text('related_products')->nullable();

			$table->timestamps();
			$table->foreign('partner_id')->references('id')->on('partners')->onDelete('set null');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

		});


		Schema::create('product_translations', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();
            $table->string('locale');

            $table->tinyInteger('status')->default(1);

			$table->string('title');
			$table->string('slug')->nullable()->unique();
			$table->text('body')->nullable();
			$table->string('summary')->nullable();

			$table->string('meta_title')->nullable();
			$table->string('meta_keywords')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('others_meta')->nullable();

            $table->timestamps();

            $table->unique(array('product_id', 'locale'));
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('product_translations');
        Schema::drop('products');
	}

}
