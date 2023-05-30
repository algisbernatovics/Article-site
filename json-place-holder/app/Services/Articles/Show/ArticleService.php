<?php

namespace App\Services\Articles;

use App\Repositories\Article\ArticleRepository;

class ArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(): ArticleResponse
    {
        return new ArticleResponse($this->articleRepository);
    }
}