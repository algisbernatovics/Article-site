<?php

namespace App\Console;

use App\Services\Articles\Show\ArticleRequest;
use App\Services\Comments\Show\CommentRequest;
use App\Services\Users\Show\UserRequest;


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
        $userRequest = new UserRequest('');
        $userResponse = $this->service->execute();
        return $userResponse->getResponse()->getUsers($userRequest->getUri());
    }

    public function allArticles(): array
    {
        $articleRequest = new ArticleRequest('');
        $articleResponse = $this->service->execute();
        return $articleResponse->getResponse()->getAllArticles($articleRequest->getUri());
    }

    public function allComments(): array
    {
        $commentRequest = new CommentRequest('');
        $commentResponse = $this->service->execute();
        return $commentResponse->getResponse()->getAllComments($commentRequest->getUri());
    }

    public function userById(int $id): array
    {
        $userRequest = new UserRequest($id);
        $userResponse = $this->service->execute();
        return $userResponse->getResponse()->getSingleUser($userRequest->getUri());
    }

    public function articlesById(int $id): array
    {
        $articleRequest = new ArticleRequest($id);
        $articleResponse = $this->service->execute();
        return $articleResponse->getResponse()->getSingleArticle($articleRequest->getUri());
    }

    public function postComments(int $id): array
    {
        $commentRequest = new CommentRequest($id);
        $commentResponse = $this->service->execute();
        return $commentResponse->getResponse()->getComments($commentRequest->getUri());
    }
}