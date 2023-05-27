<?php

//TODO The console does not notify if the record is not found.

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

    public function showInputForm()
    {
        (new Renderer())->error('UserAddEditForm.twig');
    }

    public function addUser()
    {
        $userResponse = $this->userService->execute();
        $userResponse->getResponse()->addUser($_POST);
        Functions::Redirect('/', false);
    }

    public function deleteUser()
    {
    }
}