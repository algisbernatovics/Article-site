<?php

namespace App\Services\Articles\Insert;

use App\Repositories\Article\ArticleRepository;

class InsertArticleService
{
    protected ArticleRepository $articleRepository;
    protected string $title;
    protected string $body;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute($request):bool
    {
        return ((new InsertArticleResponse($this->articleRepository))
            ->getResponse())
            ->insertArticle(
                $request->getUri(),
                $request->getTitle(),
                $request->getBody()
            );
    }
}