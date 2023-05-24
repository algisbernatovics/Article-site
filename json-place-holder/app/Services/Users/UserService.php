<?php

namespace App\Services\Users;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Repositories\User\JsonPlaceHolderUserRepository;
>>>>>>> refs/remotes/origin/main
=======
>>>>>>> ae8e32e (First Commit)
use App\Repositories\User\UserRepository;

class UserService
{
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ae8e32e (First Commit)
    protected UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository=$UserRepository;
    }

    public function execute(): UserResponse
    {
        return new UserResponse($this->UserRepository);
<<<<<<< HEAD
=======
    protected UserRepository $repository;
    protected object $usersRequest;

    public function __construct(UserRequest $usersRequest)
    {
        $this->usersRequest = $usersRequest;
        $this->repository = new JsonPlaceHolderUserRepository($usersRequest->getUri());
    }

    public function execute(): userResponse
    {
        return new UserResponse($this->repository);
>>>>>>> refs/remotes/origin/main
=======
>>>>>>> ae8e32e (First Commit)
    }
}