<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function getUsers(string $requestUri): array;
}