<?php
namespace proj1\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Tag extends Eloquent {

    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
} 