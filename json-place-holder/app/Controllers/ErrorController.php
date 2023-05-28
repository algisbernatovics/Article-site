<?php

namespace App\Controllers;

use App\Core\Renderer;

class ErrorController
{
    public function unauthorizedError(): string
    {
        return (new Renderer())->error('ErrorUnauthorized.twig');
    }

    public function errorSession(): string
    {
        return (new Renderer())->error('Error.twig');
    }

    public function errorVoid(): void
    {
        (new Renderer())->wrongEmailOrPassword('Error.twig');
    }

    public function wrongEmailOrPassword(): void
    {
        (new Renderer())->wrongEmailOrPassword('ErrorLoginFail.twig');
    }
}