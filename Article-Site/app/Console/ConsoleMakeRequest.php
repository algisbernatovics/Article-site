<?php

namespace App\Console;

use App\Services\Articles\Show\ShowArticleRequest;
use App\Services\Comments\Show\ShowCommentRequest;
use App\Services\Users\Show\ShowUserRequest;


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
        $userRequest = new ShowUserRequest('');
        $userResponse = $this->service->execute();
        return $userResponse->getResponse()->getUsers($userRequest->getUri());
    }

    public function allArticles(): array
    {
        $articleRequest = new ShowArticleRequest('');
        $articleResponse = $this->service->execute();
        return $articleResponse->getResponse()->getAllArticles($articleRequest->getUri());
    }

    public function allComments(): array
    {
        $commentRequest = new ShowCommentRequest('');
        $commentResponse = $this->service->execute();
        return $commentResponse->getResponse()->getAllComments($commentRequest->getUri());
    }

    public function userById(int $id): array
    {
        $userRequest = new ShowUserRequest($id);
        $userResponse = $this->service->execute();
        return $userResponse->getResponse()->getSingleUser($userRequest->getUri());
    }

    public function articlesById(int $id): array
    {
        $articleRequest = new ShowArticleRequest($id);
        $articleResponse = $this->service->execute();
        return $articleResponse->getResponse()->getSingleArticle($articleRequest->getUri());
    }

    public function postComments(int $id): array
    {
        $commentRequest = new ShowCommentRequest($id);
        $commentResponse = $this->service->execute();
        return $commentResponse->getResponse()->getComments($commentRequest->getUri());
    }
}