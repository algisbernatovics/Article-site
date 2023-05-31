<?php

namespace App\Services\Articles\Show;

use App\Repositories\Article\ArticleRepository;

class ShowArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(): ShowArticleResponse
    {
        return new ShowArticleResponse($this->articleRepository);
    }
}