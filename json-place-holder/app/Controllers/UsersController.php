<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Users\UsersRequest;
use App\Services\Users\UsersService;

class UsersController
{


    public function user(): string
    {
        $userService = new UsersService(new UsersRequest($_SERVER["REQUEST_URI"]));
        $userResponse = $userService->execute();

        $userPostService = new ArticleService(new ArticleRequest($_SERVER["REQUEST_URI"] . '/posts'));
        $userPostResponse = $userPostService->execute();
        return (new Renderer())->viewSingleUser('SingleUser.twig', $userResponse->getAllUsers(), $userPostResponse->getSinglePost());
    }

    public function allUsers(): string
    {
        $userService = new UsersService(new UsersRequest('/users'));
        $userResponse = $userService->execute();
        return (new Renderer())->viewUsers('Users.twig', $userResponse->getAllUsers());
    }

    public function error(): void
    {
        (new Renderer())->error('Error.twig');
    }
}