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
		$articles->getFactory ()->setViewName ( 'pagination::slider-3' );
		$this->layout->title = 'ipip\'s Blog, a level 1 light mage';
		$this->layout->main = View::make ( 'home' )->nest ( 'content', 'index', compact ( 'articles' ) );
	}
	public function getArticleAtLabel(){
		$label = Label::find(Input::get('label_id'));
		$articles = $label->articles();
		if (Auth::check()) 
			$articles = $articles->paginate(20);
		else
			$articles = $articles->where('hidden', '=', 'false')->paginate(20); 
		$articles->getFactory ()->setViewName ( 'pagination::slider-3' );
		$this->layout->title = $label->label_name;
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
	public function getSearch(){
		$search = Input::get('search');
		$articles = Article::whereRaw('match(title, content) against(? in boolean mode)', [$search])
			->where('hidden', '=', 'false')->orderBy ( 'id', 'desc' )->paginate(20); 
		$articles->getFactory ()->setViewName ( 'pagination::slider-3' );
		$this->layout->title = "[$search] in ipip";
		$this->layout->main = View::make('home')->nest ( 'content', 'index', compact ( 'articles') );
	}
	public function getTime(){
	    $time = Input::get('tid');
	    $timeu = $time.chr(126);
	    $articles = Article::where('created_at','>',$time)->where('created_at','<',$timeu)->paginate(20);
	    $articles->getFactory ()->setViewName ( 'pagination::slider-3' );
	    $this->layout->title = 'ipip\'s blog at $time';
	    $this->layout->main = View::make('home')->nest('content', 'index', compact('articles'));
	    
	}
	public function getRss(){
		$articles = Article::where('hidden', '=', 'false');
		$dom = new DOMDocument();
		
		$rss = $dom->createElement('rss');
		$rss->setAttribute('version', '1.0');
		$dom->appendChild($rss);
		
		$channel = $dom->createElement('channel');
		$rss->appendChild($channel);
		
		
		$title = $dom->createElement('title','ipip\'s blog,ipip 的个人博客');
		$link = $dom->createElement('link','http://ipipblog.net/');
		$description = $dom->createElement('description','This channel is an blog rss channel for ipipblog.net');
		$language = $dom->createElement('language','en-us');
		$channel->appendChild($title);
		$channel->appendChild($link);
		$channel->appendChild($description);
		$channel->appendChild($language);
		foreach ($articles as $article){
			$item = $dom->createElement('item');
			$channel->appendChild($item);
			$a_title = $dom->createElement('title',$article->title);
			$a_link = $dom->createElement('link','http://ipipblog.net/article/show?aid='.$article->id);
		}
		return $rss;
	}
	public function getDeadLink(){
		$file = asset('/deadlink.txt');
		$content = file_get_contents($file);
		return $content;
	}
	public function missingMethod($parameters = array()){
		return Redirect::to('/');
	}
}
