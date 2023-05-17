<?php

namespace App\Services\Users;

use App\APIClient;

class UsersService
{
    protected object $client;

    public function __construct(UsersRequest $request)
    {
        $this->client = new APIClient($request->getUri());
    }

    public function execute(): UsersResponse
    {
        return new UsersResponse($this->client);
    }
}