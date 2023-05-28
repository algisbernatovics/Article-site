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

    public function showLoginForm(): string
    {
        if (!isset($_SESSION['state'])) {
            return (new Renderer())->showLoginInputForm('ShowLoginForm.twig', true);
        } else
            return (new ErrorController())->error();
    }

    public function login(): string
    {
        if (!isset($_SESSION['state'])) {
            $response = $this->userService->execute();
            $response->getResponse()->userLogin($_POST);
            $userId = ($response->getResponse()->userLogin($_POST));
            $passwordVerifyResult = ($response->getResponse()->userLogin($_POST));

            if (!$passwordVerifyResult) {
                return (new Renderer())->showLoginInputForm('ShowLoginForm.twig', $passwordVerifyResult);
            }

            if ($passwordVerifyResult) {
                $_SESSION["state"] = $userId;
                functions::redirect('/');
            }
        }
        return (new ErrorController())->error();
    }

    public function logout(): void

    {
        unset($_SESSION['state']);
        functions::redirect('/');
    }
}