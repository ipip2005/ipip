<?php

use Illuminate\Support\Facades\Redirect;
class ArticleController extends BaseController
{

    public function getShow()
    {
    	$article = Article::findOrFail(Input::get('aid'));
        $comments = $article->comments()->get();
        $mylabels = $article->labels()->get();
        $labels = Label::all();
        $this->layout->title = strip_tags($article->title);
        $this->layout->main = View::make('home')->nest('content', 'articles.single', compact('article', 'comments', 'mylabels', 'labels'));
    }

    public function getEdit()
    {
    	if (!Auth::check())return Redirect::back();
    	$article = Article::findOrFail(Input::get('aid'));
    	if (!Session::has('title')){
    		Session::put('title',$article->title);
    		Session::put('content',$article->content);
    	}
        $this->layout->title = 'Edit Article';
        $this->layout->main = View::make('articles.edit')->with(compact('article'));
    }
	public function getRemoveSession(){
		Session::forget('title');
		Session::forget('content');
	}
    public function getDelete()
    {
    	if (!Auth::check())return Redirect::back();
    	$article = Article::findOrFail(Input::get('aid'));
        $article->delete();
        Redis::zrem('score', Input::get('aid'));
        return Redirect::to('/admin/dash-board')->with('success', 'Article is deleted!');
    }
	public function postEdit()
	{
		$new_article = [
			'title' => Input::get('title'),
			'content' => Input::get('content')
		];
		$rules = [
			'title' => 'required|max:1010',
			'content' => 'required|max:100001'
				];
		$validator = Validator::make($new_article, $rules);
		if ($validator->passes()){
			Session::forget('title');
			Session::forget('content');
			$article = Article::findOrFail(Input::get('article_id'));
			$article->title = $new_article['title'];
			$article->content = $new_article['content'];
			$article->save();
			return Redirect::to('/article/show?aid='.$article->id);
		} else{
			Session::put('title', Input::get('title'));
			Session::put('content', Input::get('content'));
			return Redirect::back()->withErrors($validator);
		}
	}
	public function postUpdateLabels(){
		$article = Article::findOrFail(Input::get('article_id'));
		$labels = Label::all();
		foreach($labels as $label){
			$article->labels()->detach($label->id);
			if (Input::get($label->id) =='on')
				$article->labels()->attach($label->id);
		}
		return Redirect::back();
	}
	public function postComment(){
		$article = Article::findOrFail(Input::get('article_id'));
		$comment = [
			'commenter' => Input::get('commenter-name'),
			'email' => Input::get('commenter-contact-information'),
			'comment' => Input::get('comment-content'),
		];
		$rules = [
			'commenter' => 'max:255',
			'email' => 'max:255',
			'comment' => 'required|max:5000'
		];
		$validator = Validator::make($comment, $rules);
		if (!$validator->passes()){
			return Redirect::back()->withErrors($validator);
		}
		if ($this->commentTooMuch()) return Redirect::back()->with('failure', 'too many comments from you, please contact admin-ipip');
		$comment = new Comment($comment);
		$comment->article_id = $article->id;
		$comment->checked = false;
		$comment->save();
		$article->comment_count++;
		$article->timestamps =false;
		$article->save();
		$article->timestamps =true; ;
		return Redirect::back();
	}
	public function commentTooMuch(){
		$ip = $this->getIpAddress();
		$key = 'comment_from_'.$ip;
		if (Redis::exists($key)){
			Redis::set($key, Redis::get($key)+1);
		} else {
			Redis::command('setex', array($key, 86400, '1'));
		}
		if (Redis::get($key)>50)
		return true;
	}
	public function getIpAddress(){
		if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknow")){
			$ip = getenv("HTTP_CLIENT_IP");
		}else if(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknow")){
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}else if(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknow")){
			$ip = getenv("REMOTE_ADDR");
		}else if(isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"],"unknow")){
			$ip = $_SERVER["REMOTE_ADDR"];
		}else{
			$ip = "unknow";
		}
		return $ip;
	}
	public function postSave(){
		Session::put('title', Input::get('title'));
		Session::put('content', Input::get('content'));
		return Response::json(array('content'=>Input::get('content')));
	}
	public function getVisit(){
		$id = Input::get('article_id');
		Article::findOrFail($id);
		$ip = $this->getIpAddress();
		$key = $id.'+'.$ip;
		if (Redis::get($key)!= 'has'){
			Redis::command('setnx', array($id, 0));
			$count = Redis::get($id) + 1;
			Redis::set($id, $count);
			Redis::command('zadd', array('score', $count, $id));
			Redis::command('setex', array($key, 3600, 'has'));
		}
		return Response::json(array('key'=>$key));
	}
	public function getToggle(){
		$article = Article::find(Input::get('article_id'));
		if ($article->hidden){
			$article->hidden = false;
			$article->timestamps =false;
			$article->save();
			$article->timestamps =true;
			return 'Hide';
		} else{
			$article->hidden = true;
			$article->timestamps =false;
			$article->save();
			$article->timestamps =true; ;
			return 'Show';
		}
	}
}
