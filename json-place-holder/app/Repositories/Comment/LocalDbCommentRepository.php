<?php

namespace App\Repositories\Comment;

use App\Core\DBALConnection;
use App\Models\Comments;

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

        $comments = [];
        foreach ($response as $comment) {
            $comments[] = new comments (
                $comment['id'],
                $comment['user_id'],
                $comment['title'],
                $comment['email'],
                $comment['body']
            );
        }
        return $comments;
    }

//Todo
    public function deleteComment(int $id): void
    {

    }

//Todo
    public function addComment(array $PostData): void
    {

    }
}


