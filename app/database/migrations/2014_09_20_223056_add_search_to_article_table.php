<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchToArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::table('articles', function (Blueprint $table) {
	        $table->dropIndex('search');
	        DB::statement('ALTER TABLE articles ADD FULLTEXT search(title, content) WITH PARSER mysqlcft');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
