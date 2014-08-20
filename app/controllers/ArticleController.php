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

    public function showArticle(Article $article)
    {
        $comments = $article->comments()->get();
        $this->layout->title = $article->title;
        $this->layout->main = View::make('home')->nest('content', 'articles.single', compact('article', 'comments'));
    }

    public function newArticle()
    {
        $this->layout->title = 'New Article';
        $this->layout->main = View::make('dash')->nest('content', 'articles.new');
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

    /* article functions */
    public function saveArticle()
    {
    	$pre = "images/".date("YmdHis",time());
        $article = [
            'title' => Input::get('title'),
            'description' => Input::get('description'),
            'image' => $_FILES['article']['name'],
        ];
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => array('regex:/^[^&%]*\\.(jpg|gif|jpeg|png|bmp)$/u'),
        ];
        $messages = array(
        	'regex' => 'Please check there is no & and % character in the file path and is an image file!!'	
        );
        $valid = Validator::make($article, $rules, $messages);
        if ($valid->passes()) {
        	$file_path = $_FILES['article']['tmp_name'];
        	$image_path = "F:/mxampp/htdocs/piclist/public/".$pre.'/'.$_FILES['article']['name'];
        	mkdir("F:/mxampp/htdocs/piclist/public/".$pre);
        	if (!move_uploaded_file($file_path, $image_path)){
        		return Redirect::to('admin/dash-board')->with('failure', 'wooops!!! failed on saving~');
        		//return Redirect::to('admin/dash_board')->with('failure', 'not valid article');
        	} else{
        		$article['image'] = $pre.'/'.$_FILES['article']['name'];
            	$article = new Article($article);
           	 	$article->comment_count = 0;
            	$article->save();
            	return Redirect::to('admin/dash-board')->with('success', 'Article is saved!');
        	}
        } else
            return Redirect::back()->withErrors($valid)->withInput();
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
