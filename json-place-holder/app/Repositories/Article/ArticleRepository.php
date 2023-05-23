<?php

namespace App\Repositories\Article;

interface ArticleRepository
{
    public function getPosts(): ?array;
}