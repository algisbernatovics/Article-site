<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Articles\Show\ShowArticleRequest;
use App\Services\Articles\Show\ShowArticleService;
use App\Services\Articles\Update\UpdateArticleRequest;
use App\Services\Articles\Update\UpdateArticleService;
use App\Services\Articles\Delete\DeleteArticleRequest;
use App\Services\Articles\Delete\DeleteArticleService;
use App\Services\Articles\Insert\InsertArticleRequest;
use App\Services\Articles\Insert\InsertArticleService;

class ArticleAddEditDeleteController
{
    private UpdateArticleService $updateArticleService;
    private ShowArticleService $showArticleService;
    private DeleteArticleService $deleteArticleService;
    private InsertArticleService $insertArticleService;


    public function __construct(
        UpdateArticleService $updateArticleService,
        ShowArticleService   $showArticleService,
        DeleteArticleService $deleteArticleService,
        InsertArticleService $insertArticleService
    )
    {
        $this->updateArticleService = $updateArticleService;
        $this->showArticleService = $showArticleService;
        $this->deleteArticleService = $deleteArticleService;
        $this->insertArticleService = $insertArticleService;
    }

    public function showAddArticleForm(): string
    {
        if (isset($_SESSION['user_id'])) {
            return (new Renderer())->showArticleInputForm('ArticleAddForm.twig');
        } else
            return (new ErrorController())->unauthorizedError();
    }

    public function showEditArticleForm(): string
    {
        if (isset($_SESSION['user_id'])) {
            $articleRequest = new ShowArticleRequest($_SERVER["REQUEST_URI"]);
            $articleResponse = $this->showArticleService->execute();
            return (new Renderer())->showArticleEditForm
            (
                'ArticleEditForm.twig',
                $articleResponse->getResponse()->getSingleArticle($articleRequest->getUri())
            );
        } else
            return (new ErrorController())->unauthorizedError();
    }

    public function deleteArticle(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new DeleteArticleRequest($_SERVER["REQUEST_URI"]);
            $response = $this->deleteArticleService->execute($request);
            if ($response) {
                Functions::Redirect('/');
            } else {
                (new ErrorController())->errorVoid();
            }
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function updateArticle(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new UpdateArticleRequest($_SERVER["REQUEST_URI"], $_POST['title'], $_POST['body']);
            $response = $this->updateArticleService->execute($request);
            if ($response) {
                Functions::Redirect('/');
            } else {
                (new ErrorController())->errorVoid();
            }
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function insertArticle(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new InsertArticleRequest($_SESSION['user_id'], $_POST['title'], $_POST['body']);
            $response = $this->insertArticleService->execute($request);
            if ($response) {
                Functions::Redirect('/');
            } else {
                (new ErrorController())->errorVoid();
            }
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }
}