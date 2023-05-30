<?php

namespace App\Services\Comments\Show;

use App\Core\Functions;

class CommentRequest
{
    protected string $uri;

    public function __construct(string $uri)
    {
        $this->uri = Functions::digitsOnly($uri);
    }

    public function getUri(): string
    {
        return $this->uri;
    }
}