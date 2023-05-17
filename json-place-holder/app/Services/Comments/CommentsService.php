<?php

namespace App\Services\Comments;

use App\APIClient;

class CommentsService
{
    protected object $client;

    public function __construct(CommentsRequest $request)
    {
        $this->client = new APIClient($request->getUri());
    }

    public function execute(): CommentsResponse
    {
        return new CommentsResponse($this->client);
    }
}