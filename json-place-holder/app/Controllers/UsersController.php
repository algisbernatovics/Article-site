<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Users\UserRequest;
use App\Services\Users\UserService;

class UsersController
{


    public function user(): string
    {
        $userService = new UserService(new UserRequest($_SERVER["REQUEST_URI"]));
        $userResponse = $userService->execute();

        $userPostService = new ArticleService(new ArticleRequest($_SERVER["REQUEST_URI"] . '/posts'));
        $userPostResponse = $userPostService->execute();
        return (new Renderer())->viewSingleUser(
            'SingleUser.twig',
            $userResponse->getUser(),
            $userPostResponse->getPosts()
        );
    }

    public function allUsers(): string
    {
        $userService = new UserService(new UserRequest('/users'));
        $userResponse = $userService->execute();
        return (new Renderer())->viewUsers('Users.twig', $userResponse->getUser());
    }
}