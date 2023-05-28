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

    public function showArticleForm(): string
    {
        if (isset($_SESSION['state'])) {
            return (new Renderer())->showForm('ArticleAddEditForm.twig');
        } else
            return (new ErrorController())->unauthorizedError();
    }

    public function addArticle(): void
    {
        if (isset($_SESSION)) {
            $articleResponse = $this->articleService->execute();
            $articleResponse->getResponse()->addArticle($_POST);
            Functions::Redirect('/', false);
        } else
            (new ErrorController())->errorSession();
    }

    public function deleteArticle(): void
    {
        if (isset($_SESSION)) {
            $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
            $articleResponse = $this->articleService->execute();
            $articleResponse->getResponse()->deleteArticle($articleRequest->getUri());
            Functions::Redirect('/', false);
        } else (new ErrorController())->errorSession();
    }
}