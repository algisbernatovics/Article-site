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

    public function showUserForm(): string
    {
        return (new Renderer())->showArticleInputForm('UserAddEditForm.twig');
    }

    public function addUser(): void
    {
        if (!isset($_SESSION['state'])) {
            $userResponse = $this->userService->execute();
            $userResponse->getResponse()->addUser($_POST);
            Functions::Redirect('/');
        } else (new ErrorController())->errorVoid();
    }

//Todo
    public function deleteUser(): void
    {

    }
}