<?php
/**
 * Created by PhpStorm.
 * User: xeon
 * Date: 23.05.14
 * Time: 10:20
 */

namespace proj1\Controllers;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use proj1\Models\Article;
use proj1\Models\Comment;

class CommentController extends BaseController {

    public function create($id) {

        if (Sentry::check()) {
            $article = Article::find($id);
            $user = Sentry::getUser();

            if($this->request->isMethod('post')) {

                $textComment = strip_tags(Input::get('comment'));

                if($textComment == "") return Redirect::route('articleDetail', array($article->id));

                $comment = new Comment();
                $comment->comment = $textComment;
                $comment->user()->associate($user);
                $comment->article()->associate($article);
                $comment->save();

                return Redirect::route('articleDetail', array($article->id));
            }
        }

        return Redirect::route('homepage');
    }
} 