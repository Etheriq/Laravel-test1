<?php
/**
 * Created by PhpStorm.
 * User: xeon
 * Date: 18.05.14
 * Time: 20:58
 */

class Comment extends Eloquent {

    public function author()
    {
        return $this->belongsTo('User');
    }

    public function article()
    {
        return $this->belongsTo('Article');
    }
} 