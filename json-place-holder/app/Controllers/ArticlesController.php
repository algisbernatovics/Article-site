<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\Show\ArticleRequest;
use App\Services\Articles\Show\ArticleService;
use App\Services\Comments\CommentRequest;
use App\Services\Comments\CommentService;


class ArticlesController
{
    private object $articleService;
    private object $commentService;

    public function __construct(articleService $articleService, commentService $commentService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
    }

    public function home(): string

    {
        return $this->allPosts();
    }

    public function allPosts(): string
    {
        $articleRequest = new ArticleRequest('/posts');
        $articleResponse = $this->articleService->execute();
        return (new Renderer())->viewPosts(
            'Articles.twig',
            $articleResponse->getResponse()->getArticles($articleRequest->getUri()));
    }

    public function post(): string
    {
        $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();

        $commentRequest = new CommentRequest($_SERVER["REQUEST_URI"] . '/comments');
        $commentResponse = $this->commentService->execute();
        return (new Renderer())->viewPostAndComments
        (
            'SingleArticle.twig',
            $articleResponse->getResponse()->getArticles($articleRequest->getUri()),
            $commentResponse->getResponse()->getComments($commentRequest->getUri())
        );
    }
}