<?php

class Article extends Eloquent {
    protected $softDelete = true;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }
} 