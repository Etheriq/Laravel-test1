<?php
/**
 * Created by PhpStorm.
 * User: xeon
 * Date: 18.05.14
 * Time: 21:10
 */

class CreatingArticles extends Seeder {

    public function run()
    {
        DB::table('articles')->truncate();

        $author = Sentry::findUserByLogin('user2@loc.com');

        $article = new Article;
        $article->title = 'article # 1';
        $article->description = 'description for article # 1';

        $article->user()->associate($author);
        $article->save();


    }
}
