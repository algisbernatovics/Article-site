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
        return (new Renderer())->userAddEditForm('UserAddEditForm.twig', true, true);
    }

    public function addUser()
    {
        $userResponse = $this->userService->execute();
        $status = ($userResponse->getResponse())->addUser($_POST);
        $passwordMatch = ($_POST['password0'] === $_POST['password1']);
        if ($status && $passwordMatch) {
            Functions::redirect('/');
        } else
            return (new Renderer())->userAddEditForm('UserAddEditForm.twig', $passwordMatch, $status);
    }

//Todo
    public
    function deleteUser(): void
    {

    }

}