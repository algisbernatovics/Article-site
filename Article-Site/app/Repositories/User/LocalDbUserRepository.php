<?php

namespace App\Repositories\User;

use App\Core\DBALConnection;
use App\Core\Functions;
use App\Models\Users;
use Doctrine\DBAL\Exception;


class LocalDbUserRepository implements UserRepository
{
    private object $DBALConnection;
    private object $queryBuilder;

    public function __construct()
    {
        $this->DBALConnection = (new DBALConnection())->getDBALConnection();
        $this->queryBuilder = $this->DBALConnection->createQueryBuilder();
    }

    public function getUsers(): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('users')
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }

    private function buildModel(array $response): array
    {
        $users = [];
        foreach ($response as $user) {
            $users[] = new Users(
                $user['id'],
                $user['name'],
                $user['username'],
                $user['email'],
                $user['city'],
                $user['phone'],
                $user['website'],
                $user['company'],
                $user['password']
            );
        }
        return $users;
    }

    public function getSingleUser($userId): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('users')
            ->where('id = :id')
            ->setParameter('id', $userId)
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }

//Todo

    public function deleteUser(int $userId): void
    {

    }

    public function userLogin($PostData): bool
    {
        $userInputEmail = $PostData['email'];
        $userInputPassword = $PostData['password'];
        $response = $this->queryBuilder->select('*')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $userInputEmail)
            ->fetchAllAssociative();

        if (count($response) === 1) {
            $verificationResult = Functions::passwordVerify($userInputPassword, $response[0]['password']);
            if ($verificationResult === true) {
                return true;
            }
        }
        return false;
    }

    public function insertUser(
        string $name,
        string $username,
        string $email,
        string $city,
        string $phone,
        string $website,
        string $company,
        string $password
    ): bool

    {
        try {

            $userPassword = Functions::hash($password);
            $this->queryBuilder

                ->insert('users')
                ->values([
                    'name' => ':name',
                    'username' => ':username',
                    'email' => ':email',
                    'city' => ':city',
                    'phone' => ':phone',
                    'website' => ':website',
                    'company' => ':company',
                    'password' => ':password',

                ])

                ->setParameter('name', $name)
                ->setParameter('username', $username)
                ->setParameter('email', $email)
                ->setParameter('city', $city)
                ->setParameter('phone', $phone)
                ->setParameter('website', $website)
                ->setParameter('company', $company)
                ->setParameter('password', $userPassword)
                ->executeStatement();

        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function getUserId(string $email): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $email)
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }
}

