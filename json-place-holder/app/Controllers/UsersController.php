<?php

namespace App\Controllers;

use App\Core\Renderer;
use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Users\UserRequest;
use App\Services\Users\UserService;

class UsersController
{
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ae8e32e (First Commit)
    private object $userService;
    private object $userArticleService;
    public function __construct(UserService $userService, ArticleService $userArticleService)
    {
        $this->userService = $userService;
        $this->userArticleService = $userArticleService;
<<<<<<< HEAD
=======


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
>>>>>>> refs/remotes/origin/main
=======
>>>>>>> ae8e32e (First Commit)
    }

    public function allUsers(): string
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ae8e32e (First Commit)
        $userRequest=new UserRequest('/users');
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

<<<<<<< HEAD
=======
        $userService = new UserService(new UserRequest('/users'));
        $userResponse = $userService->execute();
        return (new Renderer())->viewUsers('Users.twig', $userResponse->getUser());
    }
>>>>>>> refs/remotes/origin/main
=======
>>>>>>> ae8e32e (First Commit)
}