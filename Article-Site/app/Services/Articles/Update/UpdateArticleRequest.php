<?php

namespace App\Services\Articles\Update;

use App\Core\Functions;

class UpdateArticleRequest
{
    protected string $uri;
    protected string $title;
    protected string $body;

    public function __construct(string $uri,string $title,string $body)
    {
        $this->uri = Functions::digitsOnly($uri);
        $this->body = $body;
        $this->title = $title;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}