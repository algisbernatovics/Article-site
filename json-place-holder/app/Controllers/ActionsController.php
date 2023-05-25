<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Services\Articles\Show\ArticleRequest;
use App\Services\Articles\Show\ArticleService;

class ActionsController
{
    private ArticleService $articleService;

    public function __construct(articleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function addArticle()
    {
        var_dump('ādd');
        $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();
        $articleResponse->getResponse()->deleteArticle($articleRequest->getUri());
        Functions::Redirect('/', false);
    }

    public function deleteArticle()
    {
        $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();
        $articleResponse->getResponse()->deleteArticle($articleRequest->getUri());
        Functions::Redirect('/', false);
    }
}