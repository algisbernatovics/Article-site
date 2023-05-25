<?php

namespace App\Controllers;

use App\Services\Articles\Show\ArticleRequest;
use App\Services\Articles\Show\ArticleService;
use App\Services\Comments\CommentService;

class ActionsController
{
    private object $articleService;
    private CommentService $commentService;

    public function __construct(articleService $articleService, commentService $commentService)
    {
        $this->commentService = $commentService;
        $this->articleService = $articleService;
    }

    public function deleteArticle(): string
    {
        var_dump($_SERVER["REQUEST_URI"]);
        $articleRequest = new ArticleRequest($_SERVER["REQUEST_URI"]);
        $articleResponse = $this->articleService->execute();
        $articleResponse->getResponse()->deleteArticle($articleRequest->getUri());

        return (new ArticlesController($this->articleService, $this->commentService))->allPosts();
    }
}