<?php

namespace App\Repositories\Article;

interface ArticleRepository
{
    public function getArticles(string $requestUri): array;
}