<?php

namespace App\Repositories\Comment;

interface CommentRepository
{
    public function getComments(int $articleId): array;

}
