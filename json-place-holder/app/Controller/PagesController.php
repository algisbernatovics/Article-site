<?php

namespace App\Controller;

use App\APIClient;
use App\Core\Renderer;

class PagesController
{
    public function home(): string

    {
        return $this->allPosts();
    }

    public function allPosts(): string
    {
        $posts = (new APIClient('/posts'))->getAllPosts();
        return (new Renderer())->viewPosts('Posts.twig', $posts);
    }

    public function allUsers(): string
    {
        $users = (new APIClient('/users'))->getAllUsers();
        return (new Renderer())->viewUsers('Users.twig', $users);
    }
}