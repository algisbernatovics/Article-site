<?php

namespace App\Console;

use App\Services\Articles\ArticleRequest;
use App\Services\Comments\CommentRequest;
use App\Services\Users\UserRequest;


class ConsoleMakeRequest
{
    protected array $response;
    private object $service;

    public function __construct(object $service)
    {
        $this->service = $service;
        $this->response = [];
    }

    public function allUsers(): array
    {
        $userRequest = new UserRequest('users');
        $userResponse = $this->service->execute();
        return $userResponse->getResponse()->getUsers($userRequest->getUri());
    }

    public function allArticles(): array
    {
        $articleRequest = new ArticleRequest('posts');
        $articleResponse = $this->service->execute();
        return $articleResponse->getResponse()->getArticles($articleRequest->getUri());
    }

    public function allComments(): array
    {
        $commentRequest = new CommentRequest('comments');
        $commentResponse = $this->service->execute();
        return $commentResponse->getResponse()->getComments($commentRequest->getUri());
    }

    public function userById(int $id): array
    {
        $userRequest = new UserRequest('users/' . $id);
        $userResponse = $this->service->execute();
        return $userResponse->getResponse()->getUsers($userRequest->getUri());
    }

    public function articlesById(int $id): array
    {
        $articleRequest = new ArticleRequest('posts/' . $id);
        $articleResponse = $this->service->execute();
        return $articleResponse->getResponse()->getArticles($articleRequest->getUri());
    }

    public function postComments(int $id): array
    {
        $commentRequest = new CommentRequest('comments/' . $id);
        $commentResponse = $this->service->execute();
        return $commentResponse->getResponse()->getComments($commentRequest->getUri());
    }
}