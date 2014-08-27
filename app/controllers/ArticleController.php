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
		$this->layout->title = 'post failed';
		$this->layout->main = View::make('admin/dash');
	}
	public function postUpdateLabels(){
		$article = Article::find(Input::get('article_id'));
		$labels = Label::all();
		foreach($labels as $label){
			$article->labels()->detach($label->id);
			if (Input::get($label->label_name) =='on')
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
		$article->save();
		return Redirect::back();
	}
}
