<?php
/**
 * Created by PhpStorm.
 * User: xeon
 * Date: 18.05.14
 * Time: 21:10
 */
use proj1\Models\Article;

class CreatingArticles extends Seeder {

    public function run()
    {
        DB::table('articles')->delete();

        $author = Sentry::findUserByLogin('user2');

        $article = new Article;
        $article->title = 'article # 1';
        $article->description = 'description for article # 1';

        $article->user()->associate($author);
        $article->save();

        $author = Sentry::findUserByLogin('user1');

        $article = new Article;
        $article->title = 'article # 2';
        $article->description = 'description for article # 2';

        $article->user()->associate($author);
        $article->save();



    }
}
