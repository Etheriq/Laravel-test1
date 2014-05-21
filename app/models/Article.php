<?php
namespace proj1\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use proj1\Models\User;

class Article extends Eloquent {
    protected $softDelete = true;

    public function user()
    {
        return $this->belongsTo(User::class);
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