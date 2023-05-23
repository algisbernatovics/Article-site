<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function getUsers(): ?array;
}