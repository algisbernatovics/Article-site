<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Users\Show\ShowUserService;

class UserAddEditDeleteController
{
    private ShowUserService $userService;

    public function __construct(ShowUserService $userService)
    {
        $this->userService = $userService;
    }

    public function showUserForm(): string
    {
        return (new Renderer())->userAddEditForm('UserAddEditForm.twig', true, true);
    }

    public function addUser(): string
    {
        $userResponse = $this->userService->execute();
        $status = ($userResponse->getResponse())->addUser($_POST);
        $passwordMatch = ($_POST['password0'] === $_POST['password1']);
        if ($status && $passwordMatch) {
            return Functions::redirect('/loginForm');
        } else
            return (new Renderer())->userAddEditForm('UserAddEditForm.twig', $passwordMatch, $status);
    }

//Todo

    public function deleteUser(): void
    {

    }

}