<?php

namespace App\Observers;

use App\Models\Article\Article;
use App\Support\Slug\UniqueSlug;

class ArticleObserver
{
    public function creating(Article $article)
    {
        $article->slug = (new UniqueSlug)->create($article->title);
    }

    public function updating(Article $article)
    {
        $article->slug = (new UniqueSlug)->create($article->title);
    }
}
