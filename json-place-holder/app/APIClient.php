<?php


namespace App;

use App\Controllers\ErrorController;
use App\Core\Cache;
use App\Core\Functions;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\Users;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class APIClient
{
    private const BASE_URI = 'https://jsonplaceholder.typicode.com/';
    private object $client;
    private string $uri;
    private array $response;

    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->client = new Client(['base_uri' => self::BASE_URI]);
        $cacheFileName = Functions::replaceSlash($this->uri);
        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $this->uri))->getBody()->getContents();
            } catch (GuzzleException $e) {
                return (new ErrorController())->error();
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
    }

    public function getUserPosts(): array
    {
        return $this->savePosts($this->response);
    }

    public function savePosts(array $response): array
    {
        $posts = [];
        foreach ($response as $post) {
            $posts[] = new Posts (
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

    public function getAllPosts(): array
    {
        return $this->savePosts($this->response);
    }

    public function getAllComments(): array
    {
        return $this->savePostComments($this->response);
    }

    public function savePostComments(array $response): array
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

    public function getAllUsers(): array
    {
        return $this->saveUsers($this->response);
    }

    public function saveUsers(array $response): array
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

    public function getSinglePost(): array
    {
        return $this->savePosts($this->response);
    }

    public function getSingleUser(): array
    {
        return $this->saveUsers($this->response);
    }

    public function getPostComments(): array
    {
        return $this->savePostComments($this->response);
    }
}
