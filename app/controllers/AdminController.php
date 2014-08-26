<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
class AdminController extends BaseController {
	public function __construct() {
		// updated: prevents re-login.
		$this->beforeFilter ( 'auth');
	}
	
	/**
	 * get dashboard
	 */
	public function getDashBoard(){
		$layout = View::make('master');
		$layout->title = 'ipip - dashboard';
		$layout->main = View::make('admin/dash');
		return $layout;
	}
	public function getPost(){
		$this->layout->title = 'ipip - Post an article';
		$this->layout->main = View::make('admin/post')->with(array('labels' => Label::all()));
	}
	public function postArticle(){
		$article = [
			'title' => Input::get('title'),
			'content' => Input::get('content')
		];
		Session::put('title', Input::get('title'));
		Session::put('content', Input::get('content'));
		$rules = [
			'title' => 'required',
			'content' => 'required'
		];
		$validator = Validator::make($article, $rules);
		if ($validator->passes()){
			$article = new Article($article);
			$article->save();
			return Redirect::to('/article/show?aid='.$article->id);
		} else{
			return Redirect::back()->withErrors($validator);
		}		
	}
	public function getLabelManage(){
		$this->layout->title = 'ipip - Manage Labels';
		$this->layout->main = View::make('admin/labels')->with(array('labels'=>Label::all()));
	}
}
