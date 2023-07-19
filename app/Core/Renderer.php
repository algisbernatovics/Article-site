<?php

namespace App\Core;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    protected FilesystemLoader $loader;
    protected Environment $twig;
    protected ?string $sessionId;

    public function __construct()
    {
        $loader = new FilesystemLoader(ROOT_DIR . '/app/Views');
        $this->twig = new Environment($loader, [
            'debug' => true,
        ]);
        $this->twig->addExtension(new DebugExtension());
        if (isset($_SESSION['user_id'])) {
            $this->sessionId = $_SESSION['user_id'];
        } else $this->sessionId = NULL;
    }

    public function show(string $template,array $params=[]): string
    {
        $params = array_merge(['sessionId' => $this->sessionId],$params);
        return $this->twig->render($template,$params);
    }

    public function error(string $template): string
    {
        return $this->twig->render($template, ['sessionId' => $this->sessionId]);
    }

    public function errorVoid(string $template): void
    {
        $this->twig->load($template)->display();
    }

}