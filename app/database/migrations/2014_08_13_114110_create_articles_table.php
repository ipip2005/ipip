<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table){
			$table->increments('id');
			$table->string('title');
			$table->text('content');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('comment_count');
			$table->unsignedInteger('unchecked_comment_count');
			$table->unsignedInteger('like_count');
			$table->unsignedInteger('read_count');
			$table->timestamps();
			$table->engine = 'MyISAM';
		});
			DB::statement('ALTER TABLE articles ADD FULLTEXT search(title, content)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('search');
            $table->drop();
        });
		
	}

}
