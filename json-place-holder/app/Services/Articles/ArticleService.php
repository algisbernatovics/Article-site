<?php

namespace App\Services\Articles;

<<<<<<< HEAD
use App\Repositories\Article\ArticleRepository;

class ArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
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
    }

    public function execute(): ArticleResponse
    {
<<<<<<< HEAD
        return new ArticleResponse($this->articleRepository);
=======
        return new ArticleResponse($this->repository);
>>>>>>> refs/remotes/origin/main
    }
}