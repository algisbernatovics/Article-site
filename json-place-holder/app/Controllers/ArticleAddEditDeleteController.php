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

    public function showAddArticleForm(): string
    {
        if (isset($_SESSION['state'])) {
            return (new Renderer())->showArticleInputForm('ArticleAddForm.twig');
        } else
            return (new ErrorController())->unauthorizedError();
    }

    public function showEditArticleForm(): string
    {
        if (isset($_SESSION['state'])) {

            $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
            $articleResponse = $this->articleService->execute();
            return (new Renderer())->showArticleEditForm
            (
                'ArticleEditForm.twig',
                $articleResponse->getResponse()->getArticles($articleRequest->getUri())
            );
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function deleteArticle(): void
    {
        if (isset($_SESSION['state'])) {
            $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
            $articleResponse = $this->articleService->execute();
            $articleResponse->getResponse()->deleteArticle($articleRequest->getUri());
            Functions::Redirect('/');
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function updateArticle(): void
    {
        if (isset($_SESSION['state'])) {
            $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
            $articleResponse = $this->articleService->execute();
            $articleResponse->getResponse()->updateArticle($_POST, $articleRequest->getUri());
            Functions::Redirect('/');
        } else
            (new ErrorController())->unauthorizedError();
    }

    public function addArticle(): void
    {
        if (isset($_SESSION['state'])) {
            $articleResponse = $this->articleService->execute();
            $articleResponse->getResponse()->insertArticle($_POST);
            Functions::Redirect('/');
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }
}