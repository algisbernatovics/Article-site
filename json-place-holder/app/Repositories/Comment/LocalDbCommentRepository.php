<?php


namespace App\Repositories\Comment;

use App\Core\Functions;
use App\Core\PDO;
use App\Models\Comments;


class LocalDbCommentRepository implements CommentRepository
{
    private object $PDOConnection;
    private object $queryBuilder;

    public function __construct()
    {
        $this->PDOConnection = (new PDO())->getPDOconnection();
        $this->queryBuilder = $this->PDOConnection->createQueryBuilder();
    }

    public function getComments(string $requestUri): ?array
    {
        $id = Functions::digitsOnly($requestUri);

        if ($id > 0) {
            $response = $this->queryBuilder->select('*')
                ->from('comments')
                ->where("id =$id")
                ->fetchAllAssociative();
        } else {
            $response = $this->queryBuilder->select('*')
                ->from('comments')
                ->fetchAllAssociative();
        }
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

    public function deleteComment(string $requestUri)
    {
        $id = Functions::digitsOnly($requestUri);
        $this->queryBuilder
            ->delete('comments')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->executeStatement();
    }

    public function addComment($PostData)
    {
        //TODO User

        $this->queryBuilder
            ->insert('comments')
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


