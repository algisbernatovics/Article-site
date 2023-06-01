<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\Show\ShowArticleRequest;
use App\Services\Articles\Show\ShowArticleService;
use App\Services\Users\Show\ShowUserRequest;
use App\Services\Users\Show\ShowUserService;

class UserShowController
{
    private object $userService;
    private object $userArticleService;

    public function __construct(ShowUserService $userService, ShowArticleService $userArticleService)
    {
        $this->userService = $userService;
        $this->userArticleService = $userArticleService;
    }

    public function allUsers(): string
    {
        $userResponse = $this->userService->execute();
        return (new Renderer())->show(
            'ShowAllUsers.twig',
            [
                'users'=>$userResponse->getResponse()->getUsers()
            ]
        );
    }

    public function singleUser(): string
    {
        $userRequest = new ShowUserRequest($_SERVER["REQUEST_URI"]);
        $userResponse = $this->userService->execute();

        $userArticleRequest = new ShowArticleRequest($_SERVER["REQUEST_URI"]);
        $userArticleResponse = $this->userArticleService->execute();
        return (new Renderer())->show(
            'ShowSingleUser.twig',
            [
                'user'=>$userResponse->getResponse()->getSingleUser($userRequest->getUri())
            ]
        );
    }
}