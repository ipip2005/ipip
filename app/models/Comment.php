<?php

class Comment extends Eloquent
{
    protected $fillable = ['commenter', 'email', 'comment'];

    public function article()
    {
        return $this->belongsTo('Article');
    }

}
