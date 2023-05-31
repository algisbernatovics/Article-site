<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\Show\ShowArticleRequest;
use App\Services\Articles\Show\ShowArticleService;
use App\Services\Comments\Show\ShowCommentRequest;
use App\Services\Comments\Show\ShowCommentService;


class ArticleShowController
{
    private object $articleService;
    private object $commentService;

    public function __construct(ShowArticleService $articleService, ShowCommentService $commentService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
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
        $articleRequest = new ShowArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();

        $commentRequest = new ShowCommentRequest($_SERVER["REQUEST_URI"]);
        $commentResponse = $this->commentService->execute();

        return (new Renderer())->showArticleAndComments
        (
            'ShowSingleArticle.twig',
            $articleResponse->getResponse()->getSingleArticle($articleRequest->getUri()),
            $commentResponse->getResponse()->getComments($commentRequest->getUri())
        );
    }
}