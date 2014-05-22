<?php
namespace proj1\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Sentry\Users\LoginRequiredException as LoginRequired;
use Cartalyst\Sentry\Users\PasswordRequiredException as PasswordRequired;
use Cartalyst\Sentry\Users\WrongPasswordException as WrongPass;
use Cartalyst\Sentry\Users\UserNotFoundException as UserNotFound;
use Cartalyst\Sentry\Users\UserNotActivatedException as UserNotActivated;
use Cartalyst\Sentry\Throttling\UserSuspendedException as UserSuspended;
use Cartalyst\Sentry\Throttling\UserBannedException as UserBanned;
use Cartalyst\Sentry\Users\UserExistsException as UserExist;
use Cartalyst\Sentry\Users\UserAlreadyActivatedException as UserAlreadyActivated;
use Illuminate\Support\Facades\Mail;
use proj1\Models\Article;
use proj1\Models\Tag;


class ArticleController extends BaseController {

    public function create()
    {
        if ($this->request->isMethod('post')) {

            Input::flash();
            $validator = Validator::make(
                array(
                    'title' => Input::get('title'),
                    'description' => Input::get('description'),
                ),
                array(
                    'title' => 'required|min:3',
                    'description' => 'required',
                )
            );
            if($validator->fails()) {

                return Redirect::route('acticleCreate')->withInput();
            }

            $user = Sentry::getUser();
            $article = new Article();
            $article->title = Input::get('title');
            $article->description = Input::get('description');

            $article->user()->associate($user);
            $article->save();

            $p = Article::find($article->id);

            if (Input::has('tags')) {
                $tags = explode(',', trim(Input::get('tags')));
                foreach($tags as $tag) {
                    $tagObj = new Tag();
                    $tagObj->tag = trim($tag);
                    $tagObj->save();
                    $p->tags()->attach($tagObj->id);
                }
            }





            return Redirect::route('articles');
        }

        return View::make('article.create');
    }
}
