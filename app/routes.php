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
Route::group(array('domain'=>'tools.ipipblog'), function(){
	Route::controller('/', 'ToolController');
});
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
View::composer('sidebar/timeArticles', function($view){
    if (Auth::check()){
        $times = Article::get(array('created_at'));
    } else{
        $times = Article::where('hidden','=','false')->get(array('created_at'));
    }
    $time_point = array();
    foreach ($times as $single){
        $time = $single->created_at;
        $key = substr($time,0,4);//substr($time,0,4);
        $subkey = substr($time,5,2);
        if (array_key_exists($key, $time_point)){
            $time_point[$key][$subkey]='1';
        } else{
            $time_point[$key] = array($subkey=>'1');
        }
    }
    $view->times = $time_point;
});
View::composer('labelWall', function($view){
	$labels = Label::where('article_count', '>', '0')->get();
	if ($labels->count() == 0)
		$ave = 0;
	else 
		$ave = Label::sum('article_count')/$labels->count();
	$view->labels = $labels;
	$view->ave = $ave;
});
