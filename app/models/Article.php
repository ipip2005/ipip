<?php

class Article extends Eloquent
{
    protected $fillable = ['title', 'content'];

    public function comments()
    {
        return $this->hasMany('Comment');
    }
	public function labels()
	{
		return $this->hasMany('Label');
	}
    public function user()
    {
    	return $this->belongsto('User');
    }
    public function delete()
    {
        foreach ($this->comments as $comment) {
            $comment->delete();
        }
        return parent::delete();
    }
}
