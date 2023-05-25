<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;

class ActionsController
{
    private ArticleService $articleService;

    public function __construct(articleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function showInputForm()
    {
        (new Renderer())->error('ArticleForm.twig');
    }

    public function addArticle()
    {
        $articleResponse = $this->articleService->execute();
        $articleResponse->getResponse()->addArticle($_POST);
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