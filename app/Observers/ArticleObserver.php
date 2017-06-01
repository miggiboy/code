<?php

namespace App\Observers;

use App\Models\Article\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        $article->slug = str_slug($article->title);
    }

    public function updating(Article $article)
    {
        $article->slug = str_slug($article->title);
    }
}
