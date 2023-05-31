<?php

namespace App\Services\Users\Insert;

class InsertUserResponse
{
    protected object $userRepository;

    public function __construct(object $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getResponse(): object
    {
        return $this->userRepository;
    }
}