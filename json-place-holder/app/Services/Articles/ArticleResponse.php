<?php

namespace App\Services\Articles;

class ArticleResponse
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