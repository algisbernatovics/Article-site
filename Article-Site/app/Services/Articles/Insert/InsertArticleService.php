<?php

namespace App\Services\Articles\Insert;

use App\Repositories\Article\ArticleRepository;

class InsertArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute($request):bool
    {
        return ((new InsertArticleResponse($this->articleRepository))
            ->getResponse())
            ->insertArticle(
                $request->getUserId(),
                $request->getTitle(),
                $request->getBody()
            );
    }
}