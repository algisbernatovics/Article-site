<?php

namespace App\Services\Articles;

class ArticleResponse
{
    protected object $articleRepository;

    public function __construct(object $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

<<<<<<< HEAD
<<<<<<< HEAD
    public function getResponse(): object
    {
        return $this->articleRepository;
=======
    public function getPosts(): array
    {
        return $this->articleRepository->getPosts();
>>>>>>> refs/remotes/origin/main
=======
    public function getResponse(): object
    {
        return $this->articleRepository;
>>>>>>> ae8e32e (First Commit)
    }
}