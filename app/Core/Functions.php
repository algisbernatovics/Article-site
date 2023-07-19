<?php

namespace App\Core;

use Dotenv\Dotenv;

class Functions
{
    public static function replaceSlash(string $uri): string
    {
        return str_replace('/', '', $uri);
    }

    public static function defineRootDir(): void
    {
        define('ROOT_DIR', realpath(__DIR__ . '/../..'));
    }

    public static function digitsOnly(string $value): int
    {
        return (int)preg_replace('/[^0-9]/', "", $value, -1);
    }

    public static function redirect(string $url, bool $permanent = false): void
    {
        if (headers_sent() === false) {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }
    }

    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function loadDotEnv(): void
    {
        $dotenv = Dotenv::createImmutable(ROOT_DIR);
        $dotenv->load();
    }

    public static function passwordVerify($userInputPassword, $passwordHashFromDB): bool
    {
        if (password_verify($userInputPassword, $passwordHashFromDB)) {
            return true;
        } else {
            return false;
        }
    }
}