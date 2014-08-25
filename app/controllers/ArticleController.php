<?php

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
        $labels = $article->labels()->get();
        $this->layout->title = 'ipip\'s Blog';
        $this->layout->main = View::make('home')->nest('content', 'articles.single', compact('article', 'comments', 'labels'));
    }

    public function getEdit()
    {
    	$article = Article::find(Input::get('aid'));
        $this->layout->title = 'Edit Article';
        $this->layout->main = View::make('articles.edit')->with(compact('article'));
    }

    public function getDelete()
    {
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
    public function updateArticle(Article $article)
    {
        $data = [
            'title' => Input::get('title'),
            'description' => Input::get('description'),
        ];
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        $valid = Validator::make($data, $rules);
        if ($valid->passes()) {
            $article->title = $data['title'];
            $article->description = $data['description'];
            if (count($article->getDirty()) > 0) /* avoiding resubmission of same content */ {
                $article->save();
                return Redirect::back()->with('success', 'Article is updated!');
            } else
                return Redirect::back()->with('success', 'Nothing to update!');
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }
	
}
