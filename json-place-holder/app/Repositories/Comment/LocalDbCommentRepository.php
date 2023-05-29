<?php

namespace App\Repositories\Comment;

use App\Core\DBALConnection;
use App\Models\Comments;
use App\Repositories\User\LocalDbUserRepository;

class LocalDbCommentRepository implements CommentRepository
{
    private object $DBALConnection;
    private object $queryBuilder;

    public function __construct()
    {
        $this->DBALConnection = (new DBALConnection())->getDBALConnection();
        $this->queryBuilder = $this->DBALConnection->createQueryBuilder();
    }

    public function getComments(int $articleId): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('comments')
            ->where("article_id = $articleId")
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }

    private function buildModel(array $response): array
    {
        $userRepository = new LocalDbUserRepository();
        $comments = [];

        foreach ($response as $comment) {
            $userName = ($userRepository->getSingleUser($comment['user_id']))[0]->getName();
            $comments[] = new comments (
                $comment['id'],
                $comment['user_id'],
                $comment['title'],
                $comment['body'],
                $userName,
                '/users/' . $comment['user_id']
            );
        }
        return $comments;
    }

    public function getAllComments(): array
    {
        $response = $this->queryBuilder->select('*')
            ->from('comments')
            ->fetchAllAssociative();

        return $this->buildModel($response);
    }

    public function deleteComment(int $id): void
    {

    }

    public function insertComment(array $PostData, int $userId, int $articleId): void
    {
        $this->queryBuilder
            ->insert('comments')
            ->values([
                'article_id' => ':article_id',
                'user_id' => ':userId',
                'title' => ':title',
                'body' => ':body'
            ])
            ->setParameter('userId', $userId)
            ->setParameter('article_id', $articleId)
            ->setParameter('title', $PostData['title'])
            ->setParameter('body', $PostData['body'])
            ->executeStatement();
    }
}


