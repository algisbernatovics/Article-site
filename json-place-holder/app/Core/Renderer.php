<?php

namespace App\Core;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    protected FilesystemLoader $loader;
    protected Environment $twig;
    protected $sessionState;

    public function __construct()
    {
        $loader = new FilesystemLoader(ROOT_DIR . '/app/Views');
        $this->twig = new Environment($loader, [
            'debug' => true,
        ]);
        $this->twig->addExtension(new DebugExtension());
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

    public function showArticleInputForm(string $template): string
    {
        return $this->twig->render($template, ['sessionState' => $this->sessionState]);
    }

    public function userAddEditForm(string $template, bool $passwMatch, bool $emailUnique): string
    {
        return $this->twig->render($template, ['sessionState' => $this->sessionState, 'controlPasswd' => $passwMatch, 'controlEmail' => $emailUnique]);
    }

    public function showLoginInputForm(string $template, bool $loginStatus): string
    {
        return $this->twig->render($template, ['sessionState' => $this->sessionState, 'correctPassword' => $loginStatus]);
    }

    public function error(string $template): string
    {
        return $this->twig->render($template, ['sessionState' => $this->sessionState]);
    }

    public function errorVoid(string $template): void
    {
        $this->twig->load($template)->display();
    }

    public function unauthorizedErrorVoid(string $template): void
    {
        $this->twig->load($template)->display();
    }

    public function showArticleEditForm(string $template, array $article): string
    {
        return $this->twig->render(
            $template,
            ['sessionState' => $this->sessionState,
                'articles' => $article
            ]);
    }
}