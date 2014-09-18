<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/* Model Bindings */
Route::model('article', 'Article');
Route::model('comment', 'Comment');
Route::model('label', 'Label');



/* Home routes */
Route::controller('/article', 'ArticleController');
Route::controller('/admin', 'AdminController');
Route::controller('/label', 'LabelController');
Route::controller('/comment', 'CommentController');
Route::group(array('domain'=>'tools.ipipblog.net'), function(){
	Route::controller('/', 'ToolController');
});
Route::controller('/', 'BlogController');

/* View Composer */
View::composer('sidebar/recentArticles', function ($view) {
	if (Auth::check()){
		$view->recentArticles = Article::orderBy ( 'id', 'desc' )->take(10)->get();
	} else
		$view->recentArticles = Article::where('hidden', '=', 'false')->orderBy ( 'id', 'desc' )->take(10)->get();
});
View::composer('sidebar/highRateArticles', function($view) {
	$high = Redis::zrevrange('score', 0, 9, 'WITHSCORES');
	$view->high = $high;
});
