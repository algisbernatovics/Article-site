<?php

namespace App\Services\Articles;

class ArticleResponse
{
    protected object $client;

    public function __construct(object $client)
    {
        $this->client = $client;
    }

    public function getPosts(): array
    {
        return $this->client->getPosts();
    }
}