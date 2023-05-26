<?php

namespace App\Services\Users\Show;

use App\Repositories\User\UserRepository;

class UserService
{
    protected UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function execute(): UserResponse
    {
        return new UserResponse($this->UserRepository);
    }
}