<?php

namespace App\Services\Users;

class UsersResponse
{
    protected object $client;

    public function __construct(object $client)
    {
        $this->client = $client;
    }

    public function getUsers(): array
    {
        return $this->client->getUsers();
    }

}