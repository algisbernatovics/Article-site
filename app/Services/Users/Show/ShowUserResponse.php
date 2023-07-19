<?php

namespace App\Services\Users\Show;

class ShowUserResponse
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