<?php

namespace App\Services\Articles;
class ArticleRequest
{
    protected string $uri;

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function getUri(): string
    {
        return $this->uri;
    }
}