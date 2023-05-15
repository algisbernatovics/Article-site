<?php

namespace App\Controller;

use App\APIClient;
use App\Core\Renderer;

class SinglePageController
{
    public function post(): string
    {
        $post = (new APIClient())->getSinglePost($_SERVER["REQUEST_URI"]);
        $comments = (new APIClient())->getPostComments($_SERVER["REQUEST_URI"]);
        return (new Renderer())->viewPostAndComments('SinglePost.twig', $post, $comments);
    }

    public function user(): string
    {
        $user = (new APIClient())->getSingleUser($_SERVER["REQUEST_URI"]);
        return (new Renderer())->viewUsers('Users.twig', $user);
    }

    public function error()
    {
        return (new Renderer())->error('Error.twig');
    }
}