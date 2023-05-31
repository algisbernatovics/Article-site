<?php

namespace App\Services\Users\Show;

use App\Repositories\User\UserRepository;

class ShowUserService
{
    protected UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function execute(): ShowUserResponse
    {
        return new ShowUserResponse($this->UserRepository);
    }
}