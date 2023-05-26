<?php

namespace App\Models;

class Comments
{
    protected int $postId;
    protected int $id;
    protected string $name;
    protected string $email;
    protected string $body;

    public function __construct($postId, int $id, string $name, string $email, string $body)
    {
        var_dump($postId);
        $this->postId = $postId;

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->body = $body;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}