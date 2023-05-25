<?php

namespace App\Repositories\Article;

use App\Controllers\ErrorController;
use App\Core\Cache;
use App\Core\Functions;
use App\Models\Articles;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class JsonPlaceHolderArticleRepository implements ArticleRepository
{
    private const BASE_URI = 'https://jsonplaceholder.typicode.com/';
    private object $client;
    private array $response;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function getArticles($requestUri): ?array
    {
        $cacheFileName = Functions::replaceSlash($requestUri);

        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $requestUri))->getBody()->getContents();
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
        $posts = [];
        foreach ($response as $post) {
            $posts[] = new Articles (
                $post->userId,
                $post->id,
                $post->title,
                $post->body,
                '/users/' . $post->userId,
                '/posts/' . $post->id
            );
        }
        return $posts;
    }
}