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
    public function showArticle()
    {
    	$article = Article::find(Input::get('aid'));
        $comments = $article->comments()->get();
        $labels = $article->labels()->get();
        $this->layout->title = 'ipip\'s Blog';
        $this->layout->main = View::make('home')->nest('content', 'articles.single', compact('article', 'comments', 'labels'));
    }

    public function editArticle(Article $article)
    {
        $this->layout->title = 'Edit Article';
        $this->layout->main = View::make('dash')->nest('content', 'articles.edit', compact('article'));
    }

    public function deleteArticle(Article $article)
    {
    	DB::connection('mongodb')->table('likes')->where('article_id',$article->id)->delete();
    	DB::connection('mongodb')->table('count')->where('article_id',$article->id)->delete();
        $article->delete();
        return Redirect::route('article.list')->with('success', 'Article is deleted!');
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
