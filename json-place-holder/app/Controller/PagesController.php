<?php

namespace App\Controller;

use App\APIClient;
use App\Core\Renderer;

class PagesController
{
    public function home(): string
    {
        $posts = (new APIClient())->getPosts('/posts');
        return (new Renderer())->viewPosts('Posts.twig', $posts);
    }

    public function allUsers(): string
    {
        $users = (new APIClient())->getAllUsers('/users');
        return (new Renderer())->viewUsers('Users.twig', $users);
    }
}