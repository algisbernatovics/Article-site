<?php

namespace App\Services\Comments;

class CommentsResponse
{
    protected object $client;

    public function __construct(object $client)
    {
        $this->client = $client;
    }

    public function getComments(): array
    {
        return $this->client->getComments();
    }
}