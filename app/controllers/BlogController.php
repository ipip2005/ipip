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
		$this->layout->title = strip_tags($label->label_name);
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
	    if (Auth::check())
	       $articles = Article::where('created_at','>',$time)->where('created_at','<',$timeu)->
	           orderBy('id','desc')->paginate(20);
	    else 
	       $articles = Article::where('hidden','=','false')->where('created_at','>',$time)->
	           where('created_at','<',$timeu)->orderBy('id','desc')->paginate(20);
	    $articles->getFactory ()->setViewName ( 'pagination::slider-3' );
	    $this->layout->title = 'ipip\'s blog at $time';
	    $this->layout->main = View::make('home')->nest('content', 'index', compact('articles'));
	    
	}
	public function dateFormat($date){
	    $tmp = $date.'Z';
	    $tmp[10]='T';
	    $i=4;
	    str_replace('-', ':', array($tmp), $i);
	    $i=2;
	    str_replace(':', '-', array($tmp), $i);
	    return $tmp;
	}
	public function getFeed(){
	    $articles = Article::where('hidden', '=', 'false')->orderBy('id','desc')->get();
		$dom = new DOMDocument('1.0','utf-8');
		$feed = $dom->createElement('feed');
		$feed->setAttribute('xmlns', 'http://www.w3.org/2005/Atom');
		$dom->appendChild($feed);
		$title = $dom->createElement('title','ipip\'s blog,ipip 的个人博客-叶寥亮');
		$title->setAttribute('type', 'text');
		$link = $dom->createElement('link');
		$link->setAttribute('rel', 'self');
		$link->setAttribute('href', 'http://ipipblog.net/');
		
		$language = $dom->createElement('language','en-us');
		$id = $dom->createElement('id','ipip2005');
		$subtitle = $dom->createElement('subtitle','这是我业余时间用laravel框架搭建的一个分享我是生活、学习与工作的博客，并不一定每篇文章对你都是有趣的，但一定是和我零距离的事件');
		$subtitle->setAttribute('type', 'text');
		$updated = $dom->createElement('updated',$this->dateFormat($articles[0]->created_at));
	
		$feed->appendChild($title);
		$feed->appendChild($subtitle);
		$feed->appendChild($id);
		$feed->appendChild($link);
		$feed->appendChild($language);
		$feed->appendChild($updated);
		
		$author = $dom->createElement('author');
	    $name = $dom->createElement('name','ipip');
	    $uri = $dom->createElement('uri','http://ipipblog.net');
	    $author->appendChild($name);
	    $author->appendChild($uri);
	    $feed->appendChild($author);
	    $generator = $dom->createElement('generator','http://ipipblog.net');
	    $feed->appendChild($generator);
	    
	    foreach ($articles as $article){
	        $entry = $dom->createElement('entry');
	        $feed->appendChild($entry);
	        $a_id = $dom->createElement('id','http://ipipblog.net/article/show?aid='.$article->id);
	        $a_title = $dom->createElement('title',strip_tags($article->title));
	        $a_link = $dom->createElement('link');
	        $a_link->setAttribute('rel','alternate');
	        $a_link->setAttribute('href', 'http://ipipblog.net/article/show?aid='.$article->id);
	        
	        $a_link2 = $dom->createElement('link');
	        $a_link2->setAttribute('rel','alternate');
	        $a_link2->setAttribute('type', 'text/html');
	        $a_link2->setAttribute('href', 'http://ipipblog.net/article/show?aid='.$article->id);
	        $content = $dom->createElement('content','<p>url:<a href="'.'http://ipipblog.net/article/show?aid='.$article->id.'" target="_blank">'.strip_tags($article->title).'</a></p>');
	        $content->setAttribute('type', 'html');
	        $published = $dom->createElement('published',$this->dateFormat($article->created_at));
	        $updated = $dom->createElement('updated',$this->dateFormat($article->updated_at));
	        $entry->appendChild($a_id);
	        $entry->appendChild($a_title);
	        $entry->appendChild($published);
	        $entry->appendChild($updated);
	        $entry->appendChild($a_link);
	        $entry->appendChild($a_link2);
	        $entry->appendChild($author->cloneNode(true));
	        $entry->appendChild($content);
	        
	    }
	    
		$xml = new SimpleXMLElement($dom->saveXML());
		return Response::make($xml->asXML())->header('Content-type','text/xml');
	}
	public function getRss(){
		$articles = Article::where('hidden', '=', 'false')->get();
		$dom = new DOMDocument('1.0','utf-8');
		
		$rss = $dom->createElement('feed');
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
			$a_title = $dom->createElement('title',strip_tags($article->title));
			$a_link = $dom->createElement('link','http://ipipblog.net/article/show?aid='.$article->id);
			$item->appendChild($a_title);
			$item->appendChild($a_link);
		}
		$xml = new SimpleXMLElement($dom->saveXML());
		return Response::make($xml->asXML())->header('Content-type','text/xml');
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
