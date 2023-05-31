<?php


namespace App\Repositories\Article;

use App\Core\DBALConnection;
use App\Models\Articles;
use App\Repositories\User\LocalDbUserRepository;
use mysql_xdevapi\Exception;

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

    public function deleteArticle(int $articleId): bool
    {
        try {

            $this->queryBuilder
                ->delete('articles')
                ->where('id = :id')
                ->setParameter('id', $articleId)
                ->executeStatement();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function insertArticle(int $userId, string $title, string $body): bool
    {
        try {

            $this->queryBuilder
                ->insert('articles')
                ->values([
                    'user_id' => ':user_Id',
                    'title' => ':title',
                    'body' => ':body'
                ])
                ->setParameter('user_Id', $userId)
                ->setParameter('title', $title)
                ->setParameter('body', $body)
                ->executeStatement();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function updateArticle(int $articleId, string $title, string $body): bool
    {
        try {

            $this->queryBuilder
                ->update('articles')
                ->where('id = :id')
                ->set('title', ':title')
                ->set('body', ':body')
                ->setParameter('id', $articleId)
                ->setParameter('title', $title)
                ->setParameter('body', $body)
                ->executeStatement();

        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}