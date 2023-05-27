<?php

namespace App\Controllers;

use App\Core\Renderer;

class ErrorController
{
    public function wrongEmailOrPassword(): void
    {
        (new Renderer())->error('ShowWrongEmailOrPassword.twig');
    }

    public function error(): void
    {
        (new Renderer())->error('Error');
    }
}