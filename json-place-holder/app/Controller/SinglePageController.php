<?php

namespace App\Controller;

use App\APIClient;
use App\Core\Renderer;

class SinglePageController
{
    public function post(): string
    {
        $post = (new APIClient($_SERVER["REQUEST_URI"]))->getSinglePost();
        $comments = (new APIClient($_SERVER["REQUEST_URI"] . '/comments'))->getPostComments();
        return (new Renderer())->viewPostAndComments('SinglePost.twig', $post, $comments);
    }

    public function user(): string
    {
        $user = (new APIClient($_SERVER["REQUEST_URI"]))->getSingleUser();
        $posts = (new APIClient($_SERVER["REQUEST_URI"] . '/posts'))->getUserPosts();
        return (new Renderer())->viewSingleUser('SingleUser.twig', $user, $posts);
    }

    public function error(): void
    {
        (new Renderer())->error('Error.twig');
    }
}