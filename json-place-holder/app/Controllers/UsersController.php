<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Users\UserRequest;
use App\Services\Users\UserService;

class UsersController
{
    private object $userService;
    private object $userArticleService;

    public function __construct(UserService $userService, ArticleService $userArticleService)
    {
        $this->userService = $userService;
        $this->userArticleService = $userArticleService;
    }

    public function allUsers(): string
    {
        $userRequest = new UserRequest('/users');
        $userResponse = $this->userService->execute();
        return (new Renderer())->viewUsers(
            'Users.twig',
            $userResponse->getResponse()->getUsers($userRequest->getUri()));
    }

    public function user(): string
    {
        $userRequest = new UserRequest($_SERVER["REQUEST_URI"]);
        $userResponse = $this->userService->execute();

        $userArticleRequest = new ArticleRequest($_SERVER["REQUEST_URI"] . '/posts');
        $userArticleResponse = $this->userArticleService->execute();
        return (new Renderer())->viewSingleUser(
            'SingleUser.twig',
            $userResponse->getResponse()->getUsers($userRequest->getUri()),
            $userArticleResponse->getResponse()->getArticles($userArticleRequest->getUri())
        );
    }
}