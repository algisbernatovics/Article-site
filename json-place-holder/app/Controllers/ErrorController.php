<?php

namespace App\Controllers;

use App\Core\Renderer;

class ErrorController
{
    public function error(): void
    {
        (new Renderer())->error('Error.twig');
    }
}