<?php


namespace App\Repositories\Article;

use App\Core\Functions;
use App\Core\PDO;
use App\Models\Articles;


class HomeArticleRepository implements ArticleRepository
{
    private object $PDOConnection;
    private object $queryBuilder;

    public function __construct()
    {
        $this->PDOConnection = (new PDO())->getPDOconnection();
        $this->queryBuilder = $this->PDOConnection->createQueryBuilder();
    }

    public function getArticles(string $requestUri): ?array
    {
        $id = Functions::digitsOnly($requestUri);

        if ($id > 0) {
            $response = $this->queryBuilder->select('*')
                ->from('articles')
                ->where("id =$id")
                ->fetchAllAssociative();
            return $this->buildModel($response);
        } else {
            $response = $this->queryBuilder->select('*')
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
            $articles[] = new Articles (
                $article['user_id'],
                $article['id'],
                $article['title'],
                $article['body'],
                '/users/' . $article['user_id'],
                '/posts/' . $article['id']
            );
        }
        return $articles;
    }

    public function deleteArticle(string $requestUri)
    {
        $id = Functions::digitsOnly($requestUri);
        $this->queryBuilder
            ->delete('articles')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->executeStatement();
    }

    public function addArticle($PostData)
    {
        //TODO User

        $this->queryBuilder
            ->insert('articles')
            ->values([
                'title' => ':title',
                'body' => ':body',
                'user_id' => '1',
            ])
            ->setParameter('title', $PostData['title'])
            ->setParameter('body', $PostData['body'])
            ->executeStatement();
    }
}