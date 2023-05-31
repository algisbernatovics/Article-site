<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Users\Insert\InsertUserService;
use App\Services\Users\Insert\InsertUserRequest;

class UserAddEditDeleteController
{
    private InsertUserService $insertUserService;

    public function __construct(InsertUserService $insertUserService)
    {
        $this->insertUserService = $insertUserService;
    }

    public function showUserForm(): string
    {
        return (new Renderer())->userAddEditForm('UserAddEditForm.twig', true);
    }

    public function insertUser(): string
    {
        $request = new InsertUserRequest(
            $_POST['name'],
            $_POST['username'],
            $_POST['email'],
            $_POST['city'],
            $_POST['phone'],
            $_POST['website'],
            $_POST['company'],
            $_POST['password0'],
            $_POST['password1']
        );

        $status = ($this->insertUserService->execute($request));

        if ($status) {

            return Functions::redirect('/loginForm');

        } else
            return (new Renderer())->userAddEditForm('UserAddEditForm.twig', $status);
    }

//Todo

    public function deleteUser(): void
    {

    }

}