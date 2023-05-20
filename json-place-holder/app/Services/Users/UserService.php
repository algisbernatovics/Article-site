<?php

namespace App\Services\Users;

use App\Repositories\UserRepository;

class UserService
{
    protected object $repository;
    protected object $usersRequest;

    public function __construct(UserRequest $usersRequest)
    {
        $this->usersRequest = $usersRequest;
        $this->repository = new userRepository($usersRequest->getUri());
    }

    public function execute(): userResponse
    {
        return new UserResponse($this->repository);
    }
}