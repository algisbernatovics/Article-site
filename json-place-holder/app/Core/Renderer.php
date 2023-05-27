<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    protected FilesystemLoader $loader;
    protected Environment $twig;
    protected $sessionState;

    public function __construct()
    {
        $loader = new FilesystemLoader(ROOT_DIR . '/app/Views');
        $this->twig = new Environment($loader);
        $this->sessionState = $_SESSION['state'];
    }

    public function showAllArticles(string $template, array $posts): string
    {
        return $this->twig->render($template, ['posts' => $posts, 'sessionState' => $this->sessionState]);
    }

    public function showArticleAndComments(string $template, array $posts, array $comments): string
    {
        return $this->twig->render($template, ['posts' => $posts, 'comments' => $comments, 'sessionState' => $this->sessionState]);
    }

    public function showAllUsers(string $template, array $users): string
    {
        return $this->twig->render($template, ['users' => $users, 'sessionState' => $this->sessionState]);
    }

    public function showSingleUser(string $template, array $user, array $posts): string
    {
        return $this->twig->render($template, ['user' => $user, 'posts' => $posts, 'sessionState' => $this->sessionState]);
    }

    public function showForm(string $template): string
    {
        return $this->twig->render($template, ['sessionState' => $this->sessionState]);
    }

    public function error(string $template): string
    {
        return $this->twig->render($template, ['sessionState' => $this->sessionState]);
    }
}