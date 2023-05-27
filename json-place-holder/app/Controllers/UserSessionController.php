<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Users\Show\UserService;

class UserSessionController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showLoginForm(): void
    {
        (new Renderer())->showForm('ViewLoginForm.twig');
    }

    public function login(): void
    {
        $response = $this->userService->execute();
        $response->getResponse()->userLogin($_POST);
        if ($response->getResponse()->userLogin($_POST)) {


            functions::redirect('/', false);
        }
    }
}