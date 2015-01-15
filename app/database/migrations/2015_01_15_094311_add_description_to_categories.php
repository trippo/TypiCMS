<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories', function(Blueprint $table)
		{
            $table->integer('parent_id')->unsigned()->nullable()->after('id')->default(null);
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
		});
		
		Schema::table('category_translations', function(Blueprint $table)
		{
		    $table->string('excerpt')->after('slug');
		    $table->text('description')->after('excerpt');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_translations', function(Blueprint $table)
		{
		    $table->dropColumn('excerpt');
		    $table->dropColumn('description');
		});
		Schema::table('categories', function(Blueprint $table)
		{
			$table->dropForeign('categories_parent_id_foreign');
		    $table->dropColumn('parent_id');
		});
			
	}

}
