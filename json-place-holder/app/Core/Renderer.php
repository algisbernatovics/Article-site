<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(ROOT_DIR . '/app/Views');
        $this->twig = new Environment($loader);
    }

    public function showAllArticles(string $template, array $posts): string
    {
        return $this->twig->render($template, ['posts' => $posts]);
    }

    public function showArticleAndComments(string $template, array $posts, array $comments): string
    {
        return $this->twig->render($template, ['posts' => $posts, 'comments' => $comments]);
    }

    public function showAllUsers(string $template, array $users): string
    {
        return $this->twig->render($template, ['users' => $users]);
    }

    public function showSingleUser(string $template, array $user, array $posts): string
    {
        return $this->twig->render($template, ['user' => $user, 'posts' => $posts]);
    }

    public function showForm(string $template): void
    {
        $this->twig->load($template)->display();
    }

    public function error(string $template): void
    {
        $this->twig->load($template)->display();
    }
}