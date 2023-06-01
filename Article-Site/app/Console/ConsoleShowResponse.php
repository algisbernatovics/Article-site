<?php

namespace App\Console;

class ConsoleShowResponse
{
    public static function showUsers(array $response): void
    {
        foreach ($response as $user) {
            echo '-----------------------------------------' . PHP_EOL;
            echo 'ID      : ' . $user->getId() . PHP_EOL;
            echo 'Name    : ' . $user->getName() . PHP_EOL;
            echo 'UserName: ' . $user->getUserName() . PHP_EOL;
            echo 'Email   : ' . $user->getEmail() . PHP_EOL;
            echo 'City    : ' . $user->getCity() . PHP_EOL;
            echo 'Phone   : ' . $user->getPhone() . PHP_EOL;
            echo 'Website : ' . $user->getWebsite() . PHP_EOL;
            echo 'Company : ' . $user->getCompanyName() . PHP_EOL;
            echo '-----------------------------------------' . PHP_EOL;
        }
    }

    public static function showArticles(array $response): void
    {
        foreach ($response as $post) {
            echo '-----------------------------------------' . PHP_EOL;
            echo 'ID     : ' . $post->getId() . PHP_EOL;
            echo 'User ID: ' . $post->getUserId() . PHP_EOL;
            echo 'UserUrl: ' . $post->getUserUrl() . PHP_EOL;
            echo 'PostUrl: ' . $post->getPostUrl() . PHP_EOL;
            echo 'Title  : ' . $post->getTitle() . PHP_EOL;
            echo 'Body   : ' . $post->getBody() . PHP_EOL;
        }
    }

    public static function showComments(array $response): void
    {
        foreach ($response as $comment) {
            echo '-----------------------------------------' . PHP_EOL;
            echo 'ID     : ' . $comment->getCommentId() . PHP_EOL;
            echo 'Post ID: ' . $comment->getUserId() . PHP_EOL;
            echo 'Name   : ' . $comment->getTitle() . PHP_EOL;
            echo 'Body   : ' . $comment->getBody() . PHP_EOL;
        }
    }
}