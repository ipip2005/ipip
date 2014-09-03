<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
class BlogController extends BaseController {
	public function __construct() {
		// updated: prevents re-login.
		$this->beforeFilter ( 'guest', [ 
				'only' => [ 
						'getLogin' 
				] 
		] );
		$this->beforeFilter ( 'auth', [ 
				'only' => [ 
						'getLogout' 
				] 
		] );
	}
	/**
	 * generate Home Page.
	 */
	public function getIndex() {
		if (Auth::check()){
			$articles = Article::orderBy ( 'id', 'desc' )->paginate ( 20 );
		} else
			$articles = Article::where('hidden', '=', 'false')->orderBy ( 'id', 'desc' )->paginate ( 20 );
		$articles->getFactory ()->setViewName ( 'pagination::slider' );
		$this->layout->title = 'ipip\'s Blog, a level 1 light mage';
		$this->layout->main = View::make ( 'home' )->nest ( 'content', 'index', compact ( 'articles' ) );
	}
	public function getArticleAtLabel(){
		$label = Label::find(Input::get('label_id'));
		$articles = $label->articles()->paginate( 20 );
		$this->layout->title = 'ipip\'s Blog, a level 1 light mage';
		$this->layout->main = View::make ( 'home' )->nest ( 'content', 'index', compact ( 'articles') );
	}
	/**
	 * generate Login Page.
	 */
	public function getLogin() {
		$this->layout->title = 'login page';
		$this->layout->main = View::make ( 'login' );
	}
	/**
	 * generate Register Page.
	 */
	/**
	 * authorize
	 */
	public function postLogin() {
		$credentials = [ 
				'username' => Input::get ( 'username' ),
				'password' => Input::get ( 'password' ) 
		];
		$rules = [ 
				'username' => 'required',
				'password' => 'required' 
		];
		$validator = Validator::make ( $credentials, $rules );
		if ($validator->passes ()) {
			if (Auth::attempt ( $credentials ))
				return Redirect::to ( 'admin/dash-board' );
			return Redirect::back ()->withInput ()->with ( 'failure', 'username or password is invalid!' );
		} else {
			return Redirect::back ()->withErrors ( $validator )->withInput ();
		}
	}
	public function getLogout(){
		Auth::Logout();
		return Redirect::to('/');
	}
	public function missingMethod($parameters = array()){
		return Redirect::to('/');
	}
}
