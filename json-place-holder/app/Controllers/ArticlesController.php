<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Comments\CommentsRequest;
use App\Services\Comments\CommentsService;


class ArticlesController
{
    public function home(): string

    {
        return $this->allPosts();
    }

    public function allPosts(): string
    {
        $articleService = new ArticleService(new ArticleRequest('/posts'));
        $articleResponse = $articleService->execute();
        return (new Renderer())->viewPosts('Posts.twig', $articleResponse->getPosts());
    }

    public function post(): string
    {
        $postService = new ArticleService(new ArticleRequest($_SERVER["REQUEST_URI"]));
        $postResponse = $postService->execute();

        $commentService = new CommentsService(new CommentsRequest($_SERVER["REQUEST_URI"] . '/comments'));
        $commentResponse = $commentService->execute();
        return (new Renderer())->viewPostAndComments
        (
            'SinglePost.twig',
            $postResponse->getPosts(),
            $commentResponse->getComments()
        );
    }
}