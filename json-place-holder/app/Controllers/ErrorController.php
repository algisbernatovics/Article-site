<?php

namespace App\Controllers;

use App\Core\Renderer;

class ErrorController
{
    public function wrongEmailOrPassword(): string
    {
        return (new Renderer())->wrongEmailOrPassword('ShowWrongEmailOrPassword.twig');
    }

    public function error(): string
    {
        return (new Renderer())->error('Error');
    }
}