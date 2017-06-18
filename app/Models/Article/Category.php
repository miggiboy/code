<?php

namespace App\Models\Article;

use App\Models\Model;

class Category extends Model
{
    public function articles()
    {
        return $this->belongsTomany(Article::class);
    }
}
