<?php

namespace App\Services\Articles\Delete;

use App\Core\Functions;

class DeleteArticleRequest
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