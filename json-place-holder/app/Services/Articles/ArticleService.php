<?php

namespace App\Services\Articles;

use App\APIClient;

class ArticleService
{
    protected object $client;

    public function __construct(ArticleRequest $request)
    {
        $this->client = new APIClient($request->getUri());
    }

    public function execute(): ArticleResponse
    {
        return new ArticleResponse($this->client);
    }
}