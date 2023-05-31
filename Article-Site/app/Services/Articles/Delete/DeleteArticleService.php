<?php

namespace App\Services\Articles\Delete;

use App\Repositories\Article\ArticleRepository;

class DeleteArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute($request): bool
    {
        return ((new DeleteArticleResponse($this->articleRepository))
            ->getResponse())
            ->deleteArticle(
                $request->getUri()
            );
    }
}