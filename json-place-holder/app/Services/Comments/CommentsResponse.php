<?php

namespace App\Services\Comments;

class CommentsResponse
{
    protected object $client;

    public function __construct(object $client)
    {
        $this->client = $client;
    }

    public function getPostComments(): array
    {
        return $this->client->getPostComments();
    }

}