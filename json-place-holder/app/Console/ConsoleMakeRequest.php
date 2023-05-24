<?php

namespace App\Console;

use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Comments\CommentRequest;
use App\Services\Comments\CommentService;
use App\Services\Users\UserRequest;
use App\Services\Users\UserService;

class ConsoleMakeRequest
{
    protected array $response;
    private ArticleService $articleService;
    private CommentService $commentService;
    private UserService $userService;


    public function __construct()
    {
        $this->response = [];
    }

    public function allUsers(): array
    {
        $service = new UserService(new UserRequest('users'));
        $user = $service->execute();
        return $user->getUsers();
    }

    public function allPosts(): array
    {
        $service = new ArticleService(new ArticleRequest('posts'));
        $response = $service->execute();
        return $response->getPosts();
    }

    public function allComments(): array
    {
        $service = new CommentService(new CommentRequest('comments'));
        $response = $service->execute();
        return $response->getComment();
    }

    public function userById(int $id): array
    {
        $service = new UserService(new UserRequest('users/' . "$id"));
        $response = $service->execute();
        return $response->getUser();
    }

    public function postsById(int $id): array
    {
        $service = new ArticleService(new ArticleRequest('posts/' . "$id"));
        $response = $service->execute();
        return $response->getPosts();
    }

    public function postComments(int $id): array
    {
        $service = new CommentService(new CommentRequest('posts/' . "$id" . '/comments'));
        $response = $service->execute();
        return $response->getComment();
    }
}