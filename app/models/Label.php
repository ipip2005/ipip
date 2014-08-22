<?php

class Label extends Eloquent
{
    protected $fillable = ['label_name', 'father_label_id'];

    public function articles()
    {
        return $this->belongsToMany('Article');
    }

	public function fatherlabel()
	{
		return $this->belongsto('Label');
	}
}
