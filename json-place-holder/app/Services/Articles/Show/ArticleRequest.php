<?php

namespace App\Services\Articles\Show;

use App\Core\Functions;

class ArticleRequest
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