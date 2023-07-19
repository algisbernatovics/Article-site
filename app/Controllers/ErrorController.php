<?php

namespace App\Controllers;

use App\Core\Renderer;

class ErrorController
{
    public function unauthorizedError(): string
    {
        return (new Renderer())->error('ErrorUnauthorized.twig');
    }

    public function error(): string
    {
        return (new Renderer())->error('Error.twig');
    }

    public function errorVoid(): void
    {
        (new Renderer())->errorVoid('Error.twig');
    }

    public function unauthorizedErrorVoid(): void
    {
        (new Renderer())->errorVoid('ErrorUnauthorized.twig');
    }
}