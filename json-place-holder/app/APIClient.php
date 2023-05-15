<?php

namespace App;

use App\Controller\SinglePageController;
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

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function getPosts(string $uri): array
    {
        $response = $this->apiRequest($uri);
        return $this->savePosts($response);
    }

    public function apiRequest(string $uri)
    {
        $cacheFileName = Functions::replaceSlash($uri);
        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $uri))->getBody()->getContents();
            } catch (GuzzleException $e) {
                return (new SinglePageController)->error();
            }
        } else {
            $response = Cache::get($cacheFileName);
        }
        Cache::remember($cacheFileName, $response);
        return json_decode($response);
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

    public function getSinglePost(string $uri): array
    {
        $response = $this->apiRequest($uri);
        return $this->savePosts(['0' => $response]);
    }

    public function getSingleUser(string $uri): array
    {
        $response = $this->apiRequest($uri);
        return $this->saveUsers(['0' => $response]);
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

    public function getPostComments(string $uri): array
    {
        $response = $this->apiRequest($uri . '/comments');
        return $this->savePostComments($response);
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

    public function getAllUsers(string $uri): array
    {
        $response = $this->apiRequest($uri);
        return $this->saveUsers($response);
    }
}