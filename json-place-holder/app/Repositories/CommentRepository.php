<?php

namespace App\Repositories;

use App\Controllers\ErrorController;
use App\Core\Cache;
use App\Core\Functions;
use App\Models\Comments;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class CommentRepository
{
    private const BASE_URI = 'https://jsonplaceholder.typicode.com/';
    private object $client;
    private string $requestUri;
    private array $response;

    public function __construct($requestUri)
    {
        $this->requestUri = $requestUri;
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function getComments()
    {
        $cacheFileName = Functions::replaceSlash($this->requestUri);

        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $this->requestUri))->getBody()->getContents();
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
        $comments = [];
        foreach ($response as $comment) {
            $comments[] = new Comments(
                $comment->postId,
                $comment->id,
                $comment->name,
                $comment->email,
                $comment->body
            );
        }
        return $comments;
    }
}