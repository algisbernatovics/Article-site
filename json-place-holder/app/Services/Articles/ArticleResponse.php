<?php

namespace App\Services\Articles;

class ArticleResponse
{
    protected object $client;

    public function __construct(object $client)
    {
        $this->client = $client;
    }

    public function getAllPosts(): array
    {
        return $this->client->getAllPosts();
    }

    public function getSinglePost(): array
    {
        return $this->client->getSinglePost();
    }
}