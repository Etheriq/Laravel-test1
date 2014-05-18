<?php
/**
 * Created by PhpStorm.
 * User: xeon
 * Date: 18.05.14
 * Time: 21:00
 */

class Tag extends Eloquent {

    public function articles()
    {
        return $this->belongsToMany('Article');
    }
} 