<?php

use Illuminate\Support\Facades\Redirect;
class ArticleController extends BaseController
{

    /* get functions */
    public function listArticle()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        $this->layout->title = 'Article listings';
        $this->layout->main = View::make('dash')->nest('content', 'articles.list', compact('articles'));
    }
    public function getShow()
    {
    	$article = Article::find(Input::get('aid'));
        $comments = $article->comments()->get();
        $mylabels = $article->labels()->get();
        $labels = Label::all();
        $this->layout->title = 'ipip\'s Blog';
        $this->layout->main = View::make('home')->nest('content', 'articles.single', compact('article', 'comments', 'mylabels', 'labels'));
    }

    public function getEdit()
    {
    	if (!Auth::check())return Redirect::back();
    	$article = Article::find(Input::get('aid'));
    	if (!Session::has('title')){
    		Session::put('title',$article->title);
    		Session::put('content',$article->content);
    	}
        $this->layout->title = 'Edit Article';
        $this->layout->main = View::make('articles.edit')->with(compact('article'));
    }

    public function getDelete()
    {
    	if (!Auth::check())return Redirect::back();
    	$article = Article::find(Input::get('aid'));
        $article->delete();
        return Redirect::to('/admin/dash-board')->with('success', 'Article is deleted!');
    }
	public function postEdit()
	{
		$new_article = [
		'title' => Input::get('title'),
		'content' => Input::get('content')
		];
		$rules = [
		'title' => 'required',
		'content' => 'required'
				];
		$validator = Validator::make($new_article, $rules);
		if ($validator->passes()){
			Session::forget('title');
			Session::forget('content');
			$article = Article::find(Input::get('article_id'));
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
		$article = Article::find(Input::get('article_id'));
		$labels = Label::all();
		foreach($labels as $label){
			$article->labels()->detach($label->id);
			if (Input::get($label->id) =='on')
				$article->labels()->attach($label->id);
		}
		return Redirect::back();
	}
	public function postComment(){
		$article = Article::find(Input::get('article_id'));
		$comment = [
			'commenter' => Input::get('commenter-name'),
			'email' => Input::get('commenter-contact-information'),
			'comment' => Input::get('comment-content'),
		];
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
	public function postSave(){
		Session::put('title', Input::get('title'));
		Session::put('content', Input::get('content'));
		return Response::json(array('content'=>Input::get('content')));
	}
}
