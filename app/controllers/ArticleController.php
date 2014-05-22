<?php
namespace proj1\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
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
use proj1\Models\User;


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

//            $p = Article::find($article->id);

            if (Input::has('tags')) {
                $tags = explode(' ', trim(Input::get('tags')));
                foreach($tags as $tag) {
                    $tagObj = new Tag();
                    $tagObj->tag = trim($tag);
                    $tagObj->save();
                    $article->tags()->attach($tagObj->id);
//                    $p->tags()->attach($tagObj->id);
                }
            }

            return Redirect::route('articles');
        }

        return View::make('article.create');
    }

    public function detail($id) {

        $article = Article::find($id);

        return View::make('article.detail', array(
            'article' => $article,
        ));
    }

    private function getCurrentTagId($tag) {
        $ds = DB::table('tags')->select('id')->where('tag', '=', $tag)->get();

        if (count($ds) == 0){
            return null;
        } else {
            return $ds[0]->id;
        }
    }

    public function edit($id) {

        $article = Article::find($id);
        if (Sentry::check()) {

            $adminGroup = Sentry::findGroupByName('Admin');
            $user = Sentry::getUser();

            if(($article->user->id == $user->id) or ($user->inGroup($adminGroup))) {

                if ($this->request->isMethod('post'))
                {
                    $article->title = Input::get('title');
                    $article->description = Input::get('description');
                    $article->save();

                    $tags = explode(' ', trim(Input::get('tags')));
                    $finedTagsId = array();
                    foreach(array_unique($tags) as $tag) {
                        is_null($this->getCurrentTagId($tag)) ? : $finedTagsId[] = $this->getCurrentTagId($tag);
                    }

                    $tagsCurrent = $article->tags->toArray();

                    dd('Input: ', array_unique($tags), 'Fined: ', array_unique($finedTagsId), 'Current: ', array_fetch($tagsCurrent, 'id'));



//                    $tagsObj = $article->tags;
//                    foreach($tagsObj as $tag)
//                    {
//                        $article->tags()->detach($tag->id);
//                        Tag::find($tag->id)->delete();
//                    }
//
//                    if (Input::has('tags')) {
//                        $tags = explode(' ', trim(Input::get('tags')));
//                        foreach($tags as $tag) {
//                            $tagObj = new Tag();
//                            $tagObj->tag = trim($tag);
//                            $tagObj->save();
//                            $article->tags()->attach($tagObj->id);
//                        }
//                    }

                    return Redirect::route('articleDetail', array($id));
                }

                return View::make('article.edit', array('article' => $article));
            } else {
                Session::flash('info', 'Access deny');

                return Redirect::route('articleDetail', array($id));
            }
        } else {

            return Redirect::guest('login');
        }
    }

}
