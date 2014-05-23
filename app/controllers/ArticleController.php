<?php
namespace proj1\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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

            if(Input::has('tags')) {
                foreach($article->tags as $tag)
                {
                    $article->tags()->detach($tag->id);
                }

                $str = str_replace(array(',', ';', ':', '.'), ' ', trim(Input::get('tags')));
                $str = preg_replace('/\s+/',' ',$str);
                $tags = explode(' ', $str);

                foreach(array_unique($tags) as $tag) {
                    if(is_null($this->checkTagExisting($tag))) {
                        $newTag = new Tag();
                        $newTag->tag = $tag;
                        $newTag->save();
                        $article->tags()->attach($newTag->id);
                    } else {
                        $article->tags()->attach($this->checkTagExisting($tag));
                    }
                }
            } else {
                foreach($article->tags as $tag)
                {
                    $article->tags()->detach($tag->id);
                }
            }

            return Redirect::route('articles');
        }

        return View::make('article.create');
    }

    public function detail($id) {

        if(is_null(Article::find($id))) {

            return Redirect::route('articles');
        } else {
            $article = Article::find($id);
        }

        return View::make('article.detail', array(
            'article' => $article,
        ));
    }

    private function checkTagExisting($tag) {
        $tagObj = DB::table('tags')->where('tag','=', $tag)->first();

        return is_null($tagObj) ? null : $tagObj->id;
    }

    public function edit($id) {

        if(is_null(Article::find($id))) {

            return Redirect::route('articles');
        } else {
            $article = Article::find($id);
        }

        if (Sentry::check()) {

            $adminGroup = Sentry::findGroupByName('Admin');
            $user = Sentry::getUser();

            if(($article->user->id == $user->id) or ($user->inGroup($adminGroup))) {

                if ($this->request->isMethod('post'))
                {
                    $article->title = Input::get('title');
                    $article->description = Input::get('description');
                    $article->save();

                    if(Input::has('tags')) {
                        foreach($article->tags as $tag)
                        {
                            $article->tags()->detach($tag->id);
                        }

                        $str = str_replace(array(',', ';', ':', '.'), ' ', trim(Input::get('tags')));
                        $str = preg_replace('/\s+/',' ',$str);
                        $tags = explode(' ', $str);

                        foreach(array_unique($tags) as $tag) {
                            if(is_null($this->checkTagExisting($tag))) {
                                $newTag = new Tag();
                                $newTag->tag = $tag;
                                $newTag->save();
                                $article->tags()->attach($newTag->id);
                            } else {
                                $article->tags()->attach($this->checkTagExisting($tag));
                            }
                        }
                    } else {
                        foreach($article->tags as $tag)
                        {
                            $article->tags()->detach($tag->id);
                        }
                    }

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

    public function showByTag($tag) {

        $tagObj = Tag::where('tag', $tag)->first();

        if (is_null($tagObj)) {

            return Redirect::route('articles');
        }  else {

            return View::make('article.articlesByTag', array(
                'tag' => $tagObj,
            ));
        }
    }
}
