<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Users\Show\UserService;

class UserAddEditDeleteController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }

    public function showUserAddEditForm(): void
    {
        (new Renderer())->showForm('UserAddEditForm.twig');
    }

    public function addUser(): void
    {
        $userResponse = $this->userService->execute();
        $userResponse->getResponse()->addUser($_POST);
        Functions::Redirect('/', false);
    }

    public function deleteUser(): void
    {
    }
}