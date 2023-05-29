<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\Show\ArticleRequest;
use App\Services\Articles\Show\ArticleService;
use App\Services\Comments\Show\CommentRequest;
use App\Services\Comments\Show\CommentService;
use App\Services\Users\Show\UserService;


class ArticleShowController
{
    private object $articleService;
    private object $commentService;
    private object $userService;

    public function __construct(articleService $articleService, commentService $commentService, userService $userService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->userService = $userService;
    }

    public function home(): string

    {
        return $this->allArticles();
    }

    public function allArticles(): string
    {
        $articleResponse = $this->articleService->execute();

        return (new Renderer())->showAllArticles(
            'ShowAllArticles.twig',
            $articleResponse->getResponse()->getAllArticles(),
        );
    }

    public function singleArticle(): string
    {
        $userService = $this->userService->execute();

        $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();

        $commentRequest = new CommentRequest($_SERVER["REQUEST_URI"]);
        $commentResponse = $this->commentService->execute();

        return (new Renderer())->showArticleAndComments
        (
            'ShowSingleArticle.twig',
            $articleResponse->getResponse()->getSingleArticle($articleRequest->getUri()),
            $commentResponse->getResponse()->getComments($commentRequest->getUri())

        );
    }
}