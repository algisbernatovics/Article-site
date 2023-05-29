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

    public function addUser($PostData): bool
    {
        try {
            $userPassword = Functions::hash($PostData['password0']);
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
                ->setParameter('name', $PostData['name'])
                ->setParameter('username', $PostData['username'])
                ->setParameter('email', $PostData['email'])
                ->setParameter('city', $PostData['city'])
                ->setParameter('phone', $PostData['phone'])
                ->setParameter('website', $PostData['website'])
                ->setParameter('company', $PostData['company'])
                ->setParameter('password', $userPassword)
                ->executeStatement();

        } catch (Exception $exception) {

            if (!isset($_SERVER['argv'])) {
                return false;
            }
            if (isset($_SERVER['argv'])) {
                throw new Exception("SQLState 23000 Duplicate Email Entry");

            }
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

