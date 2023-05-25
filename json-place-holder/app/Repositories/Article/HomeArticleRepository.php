<?php


namespace App\Repositories\Article;

use App\Core\Functions;
use App\Core\PDO;
use App\Models\Posts;


class HomeArticleRepository implements ArticleRepository
{
    private object $PDOConnection;

    public function __construct()
    {
        $this->PDOConnection = (new PDO())->getPDOconnection();
    }

    public function getArticles(string $requestUri): ?array
    {
        $id = Functions::digitsOnly($requestUri);
        $queryBuilder = $this->PDOConnection->createQueryBuilder();

        if ($id > 0) {
            $response = $queryBuilder->select('*')
                ->from('articles')
                ->where("id =$id")
                ->fetchAllAssociative();
            return $this->buildModel($response);
        } else {
            $response = $queryBuilder->select('*')
                ->from('articles')
                ->fetchAllAssociative();
            return $this->buildModel($response);
        }
    }

    private
    function buildModel(array $response): array
    {
        $articles = [];
        foreach ($response as $article) {
            $articles[] = new Posts (
                $article['id'],
                $article['user_id'],
                $article['title'],
                $article['body'],
                '/users/' . $article['user_id'],
                '/posts/' . $article['id']
            );
        }
        return $articles;
    }
}