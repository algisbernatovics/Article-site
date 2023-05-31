<?php

namespace App\Services\Articles\Update;

class UpdateArticleResponse
{
    protected object $articleRepository;

    public function __construct(object $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getResponse(): object
    {
        return $this->articleRepository;
    }
}