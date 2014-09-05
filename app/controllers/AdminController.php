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
		$rules = [
			'title' => 'required|max:1010',
			'content' => 'required|max:100001'
		];
		$validator = Validator::make($article, $rules);
		if ($validator->passes()){
			Session::forget('title');
			Session::forget('content');
			$article = new Article($article);
			$article->save();
			return Redirect::to('/article/show?aid='.$article->id);
		} else{
			Session::put('title', Input::get('title'));
			Session::put('content', Input::get('content'));
			return Redirect::back()->withErrors($validator);
		}		
	}
	public function getLabelManage(){
		$this->layout->title = 'ipip - Manage Labels';
		$this->layout->main = View::make('admin/labels')->with(array('labels'=>Label::all()));
	}
	public function getCommentManage(){
		$comments = Comment::orderBy ('checked')->orderBy('id', 'desc')->paginate ( 20 );
		$comments->getFactory ()->setViewName ( 'pagination::slider' );
		$this->layout->title = 'ipip - Manage Comments';
		$this->layout->main = View::make('admin/comments')->with(compact('comments'));
	}
	public function getHiddenArticles(){
		$articles = Article::where('hidden', '=', '1')->orderBy('updated_at', 'desc')->paginate(10);
		$articles->getFactory ()->setViewName ( 'pagination::slider' );
		$this->layout->title = 'ipip - HiddenArticles';
		$this->layout->main = View::make ( 'index' )->with('articles', $articles);
	}
}
