<?php
namespace proj1\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent {

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
} 