<?php

namespace App\Services\Users;

use App\Repositories\User\JsonPlaceHolderUserRepository;

class UserService
{
    protected object $repository;
    protected object $usersRequest;

    public function __construct(UserRequest $usersRequest)
    {
        $this->usersRequest = $usersRequest;
        $this->repository = new JsonPlaceHolderUserRepository($usersRequest->getUri());
    }

    public function execute(): userResponse
    {
        return new UserResponse($this->repository);
    }
}