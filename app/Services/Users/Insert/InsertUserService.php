<?php

namespace App\Services\Users\Insert;

use App\Repositories\User\UserRepository;

class InsertUserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute($request): bool
    {
        if ($request->getPassword0() === $request->getPassword1()) {

            return ((new InsertUserResponse($this->userRepository))

                ->getResponse())
                ->insertUser(
                    $request->getName(),
                    $request->getUserName(),
                    $request->getEmail(),
                    $request->getCity(),
                    $request->getPhone(),
                    $request->getWebsite(),
                    $request->getCompany(),
                    $request->getPassword0(),
                );

        } else return false;

    }
}
