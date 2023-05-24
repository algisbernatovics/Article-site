<?php

namespace App\Repositories\User;

use App\Controllers\ErrorController;
use App\Core\Cache;
use App\Core\Functions;
use App\Models\Users;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class JsonPlaceHolderUserRepository implements UserRepository
{
    private const BASE_URI = 'https://jsonplaceholder.typicode.com/';
    private object $client;
    private array $response;
<<<<<<< HEAD

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function getUsers($requestUri): ?array
    {
        $cacheFileName = Functions::replaceSlash($requestUri);
        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $requestUri))->getBody()->getContents();
=======
    private string $requestUri;

    public function __construct(string $requestUri)
    {
        $this->requestUri = $requestUri;
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function getUsers(): ?array
    {
        $cacheFileName = Functions::replaceSlash($this->requestUri);
        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $this->requestUri))->getBody()->getContents();
>>>>>>> refs/remotes/origin/main
            } catch (GuzzleException $e) {
                if (!isset($_SERVER['argv'])) {
                    return (new ErrorController())->error();
                }
                if (isset($_SERVER['argv'])) {
                    throw new RuntimeException;
                }
            }
        } else {
            $response = Cache::get($cacheFileName);
        }
        Cache::remember($cacheFileName, $response);
        if ((gettype(json_decode($response))) === 'array') {
            $this->response = json_decode($response);
        }
        if ((gettype(json_decode($response))) === 'object') {
            $this->response = ['0' => json_decode($response)];
        }
        return $this->buildModel($this->response);
    }

    private function buildModel(array $response): array
    {
        $users = [];
        foreach ($response as $user) {
            $users[] = new Users(
                $user->id,
                $user->name,
                $user->username,
                $user->email,
                $user->address->city,
                $user->phone,
                $user->website,
                $user->company->name
            );
        }
        return $users;
    }
}