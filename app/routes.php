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
Route::get('articles', array(
    'as' => 'articles',
    function()
    {
        $articles = Article::all();
        return View::make('article.articles', array(
            'articles' => $articles,
        ));
    }
));

Route::get('login', array(
    'as' => 'login',
    'uses' => 'UserController@login',
));
Route::post('login', array(
    'as' => 'login',
    'uses' => 'UserController@login',
));




Route::group(array('before' => 'auth'), function () {


//
//    Route::get('/', function () {
//        // К этому маршруту привязан фильтр auth.
//    });
//
//    Route::get('user/profile', function () {
//        // К этому маршруту также привязан фильтр auth.
//    });
});