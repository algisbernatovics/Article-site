<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/Views');
        $this->twig = new Environment($loader);
    }

    public function viewPosts(string $template, array $posts): string
    {
        return $this->twig->render($template, ['posts' => $posts]);
    }

    public function viewPostAndComments(string $template, array $posts, array $comments): string
    {
        return $this->twig->render($template, ['posts' => $posts, 'comments' => $comments]);
    }

    public function viewUsers(string $template, array $users): string
    {
        return $this->twig->render($template, ['users' => $users]);
    }

    public function error(string $template): void
    {
        $this->twig->load($template)->display();
    }
}