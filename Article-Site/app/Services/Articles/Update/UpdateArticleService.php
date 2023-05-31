<?php

namespace App\Services\Articles\Update;

use App\Repositories\Article\ArticleRepository;

class UpdateArticleService
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
        return ((new UpdateArticleResponse($this->articleRepository))
            ->getResponse())
            ->updateArticle(
                $request->getUri(),
                $request->getTitle(),
                $request->getBody()
            );
    }
}