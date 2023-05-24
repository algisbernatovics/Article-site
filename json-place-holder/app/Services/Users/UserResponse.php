<?php

namespace App\Services\Users;

class UserResponse
{
    protected object $userRepository;

    public function __construct(object $userRepository)
    {
        $this->userRepository = $userRepository;
    }

<<<<<<< HEAD
    public function getResponse(): object
    {
        return $this->userRepository;
=======
    public function getUser(): array
    {
        return $this->userRepository->getUsers();
>>>>>>> refs/remotes/origin/main
    }
}