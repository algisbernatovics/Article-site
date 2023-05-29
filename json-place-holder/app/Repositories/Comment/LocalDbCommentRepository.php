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

    public function getComments(string $requestUri): array
    {
        $id = Functions::digitsOnly($requestUri);

        $response = $this->queryBuilder->select('*')
            ->from('comments')
            ->where("article_id = $id")
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
    public function deleteComment(string $requestUri)
    {

    }

//Todo
    public function addComment($PostData)
    {

    }
}


