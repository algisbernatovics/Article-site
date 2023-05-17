<?php

use App\Services\Articles\ArticleRequest;
use App\Services\Articles\ArticleService;
use App\Services\Comments\CommentsRequest;
use App\Services\Comments\CommentsService;
use App\Services\Users\UsersRequest;
use App\Services\Users\UsersService;

require_once '../../vendor/autoload.php';

class Console
{
    public array $argv;
    protected array $response;

    public function __construct($argv)
    {
        $this->argv = $argv;

    }

    public function users(): array
    {
        $service = new UsersService(new UsersRequest($this->argv[1]));
        $response = $service->execute();
        return $this->response = $response->getAllUsers();
    }

    public function posts(): array
    {
        $service = new ArticleService(new ArticleRequest($this->argv[1]));
        $response = $service->execute();
        return $this->response = $response->getAllPosts();
    }

    public function comments(): array
    {
        $service = new CommentsService(new CommentsRequest($this->argv[1]));
        $response = $service->execute();
        return $this->response = $response->getAllComments();
    }
}

$response = (new Console($argv))->{$argv[1]}();
if ($argv[1] === 'users') {
    foreach ($response as $user) {
        echo '-----------------------------------------' . PHP_EOL;
        echo 'ID: ' . $user->getId() . PHP_EOL;
        echo 'Name: ' . $user->getName() . PHP_EOL;
        echo 'UserName: ' . $user->getUserName() . PHP_EOL;
    }
}
if ($argv[1] === 'posts') {
    foreach ($response as $post) {
        echo '-----------------------------------------' . PHP_EOL;
        echo 'ID: ' . $post->getId() . PHP_EOL;
        echo 'Body: ' . $post->getBody() . PHP_EOL;
    }
}
if ($argv[1] === 'comments') {
    foreach ($response as $comment) {
        echo '-----------------------------------------' . PHP_EOL;
        echo 'ID: ' . $comment->getId() . PHP_EOL;
        echo 'Body: ' . $comment->getBody() . PHP_EOL;
    }
}
