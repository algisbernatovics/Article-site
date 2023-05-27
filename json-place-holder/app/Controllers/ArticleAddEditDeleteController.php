<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Articles\Show\ArticleRequest;
use App\Services\Articles\Show\ArticleService;

class ArticleAddEditDeleteController
{
    private ArticleService $articleService;

    public function __construct(articleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function showInputForm(): void
    {
        (new Renderer())->showForm('ArticleAddEditForm.twig');
    }

    public function addArticle(): void
    {
        $articleResponse = $this->articleService->execute();
        $articleResponse->getResponse()->addArticle($_POST);
        Functions::Redirect('/', false);
    }

    public function deleteArticle(): void
    {
        $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();
        $articleResponse->getResponse()->deleteArticle($articleRequest->getUri());
        Functions::Redirect('/', false);
    }
}