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
        if (!isset($_SESSION['user_id'])) {
            return (new Renderer())->showLoginInputForm('ShowLoginForm.twig', true);
        } else
            return (new ErrorController())->error();
    }

    public function login(): string
    {
        if (!isset($_SESSION['user_id'])) {
            $response = $this->userService->execute();
            $passwordVerifyResult = $response->getResponse()->userLogin($_POST);
            if (!$passwordVerifyResult) {
                return (new Renderer())->showLoginInputForm('ShowLoginForm.twig', $passwordVerifyResult);
            }
            if ($passwordVerifyResult) {
                $userId = ((($response->getResponse())->getUserId($_POST['email'])[0])->getId());
                $_SESSION['user_id'] = $userId;
                Functions::redirect('/');
            }
        }
        return (new ErrorController())->error();
    }

    public function logout(): void

    {
        unset($_SESSION['user_id']);
        functions::redirect('/');
    }
}