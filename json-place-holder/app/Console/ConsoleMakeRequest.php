<?php

namespace App\Console;

use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Comments\CommentsRequest;
use App\Services\Comments\CommentsService;
use App\Services\Users\UsersRequest;
use App\Services\Users\UsersService;

class ConsoleMakeRequest
{
    function allUsers(): array
    {
        $service = new UsersService(new UsersRequest('users'));
        $response = $service->execute();
        return $response->getUsers();
    }

    function allPosts(): array
    {
        $service = new ArticleService(new ArticleRequest('posts'));
        $response = $service->execute();
        return $response->getPosts();
    }

    function allComments(): array
    {
        $service = new CommentsService(new CommentsRequest('comments'));
        $response = $service->execute();
        return $response->getComments();
    }

    function userById($id): array
    {
        $service = new UsersService(new UsersRequest('users/' . "$id"));
        $response = $service->execute();
        return $response->getUsers();
    }

    function postsById($id): array
    {
        $service = new ArticleService(new ArticleRequest('posts/' . "$id"));
        $response = $service->execute();
        return $response->getPosts();
    }

    function postComments($id): array
    {
        $service = new CommentsService(new CommentsRequest('posts/' . "$id" . '/comments'));
        $response = $service->execute();
        return $response->getComments();
    }
}