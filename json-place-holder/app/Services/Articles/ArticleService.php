<?php

namespace App\Services\Articles;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ae8e32e (First Commit)
use App\Repositories\Article\ArticleRepository;

class ArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
<<<<<<< HEAD
=======

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\JsonPlaceHolderArticleRepository;

class ArticleService
{
    protected ArticleRepository $repository;
    protected object $articleRequest;

    public function __construct(ArticleRequest $articleRequest)
    {
        $this->articleRequest = $articleRequest;
        $this->repository = new JsonPlaceHolderArticleRepository($articleRequest->getUri());
>>>>>>> refs/remotes/origin/main
=======
>>>>>>> ae8e32e (First Commit)
    }

    public function execute(): ArticleResponse
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return new ArticleResponse($this->articleRepository);
=======
        return new ArticleResponse($this->repository);
>>>>>>> refs/remotes/origin/main
=======
        return new ArticleResponse($this->articleRepository);
>>>>>>> ae8e32e (First Commit)
    }
}