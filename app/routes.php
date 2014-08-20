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

/* View Composer */
View::composer('recentArticles', function ($view) {
	$view->recentArticles = Article::orderBy('id', 'desc')->take(10)->get();
});
View::composer('highRateArticles', function($view) {
	$view->highRateArticles = Article::orderBy('read_count', 'desc')->take(10)->get();
});

/* Home routes */
Route::controller('/', 'BlogController');


