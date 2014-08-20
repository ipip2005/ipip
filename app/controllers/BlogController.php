<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
class BlogController extends BaseController
{
	public function __construct()
	{
		//updated: prevents re-login.
		$this->beforeFilter('guest', ['only' => ['getLogin']]);
		$this->beforeFilter('auth', ['only' => ['getLogout']]);
	}
	/**
	 * generate Home Page.
	 */	
	public function getIndex()
	{
		$articles = Article::orderBy('id', 'desc')->paginate(20);
		$articles->getFactory()->setViewName('最近发表：');
		$this->layout->title = 'ipip\'s Blog, a level 1 light mage';
		$this->layout->main = View::make('home')->nest('content', 'index', compact('articles'));
	}
	
}
