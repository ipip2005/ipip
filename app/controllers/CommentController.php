<?php

use Illuminate\Support\Facades\Redirect;
class CommentController extends BaseController
{
	public function getDelete(){
		if (!Auth::check())return Redirect::back();
		$comment = Comment::find(Input::get('cid'));
		if ($comment->article_id!=''){
			$article = Article::find($comment->article_id);
			$article->comment_count--;
			$article->timestamps =false;
			$article->save();
			$article->timestamps =true;  
		}
		$comment->delete();
		return Redirect::back();
	}
	public function getCheck(){
		$comment = Comment::find(Input::get('cid'));
		$comment->checked = true;
		$comment->save();
		return 200;
	}
	public function postMessage(){
		$comment = [
			'comment' => Input::get('message'),
		];
		$comment = new Comment($comment);
		$comment->save();
		return Redirect::back();
	}
}
