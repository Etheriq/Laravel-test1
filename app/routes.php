<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
        'as' => 'homepage',
        function()
        {
            return View::make('homepage.homepage');
        }
    ));
Route::get('article', array(
    'as' => 'articles',
    function()
    {
        $articles = proj1\Models\Article::all();
        return View::make('article.articles', array(
            'articles' => $articles,
        ));
    }
));

Route::get('login', array(
    'as' => 'login',
    'uses' => 'proj1\Controllers\UserController@login',
));
Route::post('login', array(
    'as' => 'login',
    'uses' => 'proj1\Controllers\UserController@login',
));

Route::get('register', array(
    'as' => 'register',
    'uses' => 'proj1\Controllers\UserController@register',
));
Route::post('register', array(
    'as' => 'register',
    'uses' => 'proj1\Controllers\UserController@register',
));

Route::get('user/activation', array(
    'as' => 'activation',
    'uses' => 'proj1\Controllers\UserController@activation',
));

Route::get('article/{id}/view', array(
    'as' => 'articleDetail',
    'uses' => 'proj1\Controllers\ArticleController@detail',
));

Route::get('tag/{tag}', array(
    'as' => 'articleShowByTag',
    'uses' => 'proj1\Controllers\ArticleController@showByTag',
));






Route::group(array('before' => 'auth'), function () {
    Route::get('user/profile', array(
        'as' => 'profile',
        function () {
            return View::make('user.profile');
        }
    ));

    Route::get('logout', array(
        'as' => 'logout',
        function() {
            Sentry::logout();
            return Redirect::route('homepage');
        }
    ));

    Route::get('email/send', array(
        'as' => 'email',
        'uses' => 'proj1\Controllers\MailController@send'
    ));
    Route::post('email/send', array(
        'as' => 'email',
        'uses' => 'proj1\Controllers\MailController@send'
    ));

    Route::get('article/create', array(
        'as' => 'acticleCreate',
        'uses' => 'proj1\Controllers\ArticleController@create'
    ));
    Route::post('article/create', array(
        'as' => 'acticleCreate',
        'uses' => 'proj1\Controllers\ArticleController@create'
    ));
    Route::get('article/{id}/edit', array(
        'as' => 'articleEdit',
        'uses' => 'proj1\Controllers\ArticleController@edit'
    ));
    Route::post('article/{id}/edit', array(
        'as' => 'articleEdit',
        'uses' => 'proj1\Controllers\ArticleController@edit'
    ));
    Route::post('article/{id}/comment/create', array(
        'as' => 'commentCreate',
        'uses' => 'proj1\Controllers\CommentController@create'
    ));

});

Route::group(array('prefix' => 'api/v1', 'before' => 'api_auth'), function() {
    Route::get('test1', array(
        'as' => 'apitest1',
        'uses' => 'proj1\Controllers\ApiController@ttt'
    ));



});