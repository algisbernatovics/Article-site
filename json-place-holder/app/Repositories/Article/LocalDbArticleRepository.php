<?php


namespace App\Repositories\Article;

use App\Core\DBALConnection;
use App\Models\Articles;
use App\Repositories\User\LocalDbUserRepository;

class LocalDbArticleRepository implements ArticleRepository
{
    private object $DBALConnection;
    private object $queryBuilder;

    public function __construct()
    {
        $this->DBALConnection = (new DBALConnection())->getDBALConnection();
        $this->queryBuilder = $this->DBALConnection->createQueryBuilder();
    }

    public function getAllArticles(): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('articles')
            ->fetchAllAssociative();
        return $this->buildModel($response);
    }

    private function buildModel(array $response): array
    {
        $userRepository = new LocalDbUserRepository();
        $articles = [];
        foreach ($response as $article) {
            $userName = ($userRepository->getSingleUser($article['user_id']))[0]->getName();
            $articles[] = new Articles (
                $article['user_id'],
                $article['id'],
                $article['title'],
                $article['body'],
                '/users/' . $article['user_id'],
                '/posts/' . $article['id'],
                $userName
            );
        }
        return $articles;
    }

    public function getUserArticles(int $userId): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('articles')
            ->where("user_id = $userId")
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }

    public function getSingleArticle(int $articleId): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('articles')
            ->where("id = $articleId")
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }

    public function deleteArticle(int $articleId): void
    {
        $this->queryBuilder
            ->delete('articles')
            ->where('id = :id')
            ->setParameter('id', $articleId)
            ->executeStatement();
    }

    public function insertArticle(array $PostData, int $userId): void
    {
        $this->queryBuilder
            ->insert('articles')
            ->values([
                'title' => ':title',
                'body' => ':body',
                'user_id' => ':user_Id',
            ])
            ->setParameter('title', $PostData['title'])
            ->setParameter('body', $PostData['body'])
            ->setParameter('user_Id', $userId)
            ->executeStatement();
    }

    public function updateArticle(array $PostData, int $articleId): void
    {
        $this->queryBuilder
            ->update('articles')
            ->where('id = :id')
            ->set('title', ':title')
            ->set('body', ':body')
            ->setParameter('id', $articleId)
            ->setParameter('title', $PostData['title'])
            ->setParameter('body', $PostData['body'])
            ->executeStatement();
    }
}