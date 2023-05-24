<?php


namespace App\Core;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\JsonPlaceHolderArticleRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\JsonPlaceHolderCommentRepository;
use App\Repositories\User\JsonPlaceHolderUserRepository;
use App\Repositories\User\UserRepository;
use DI\ContainerBuilder;

class Container
{
    protected object $container;
    public function __construct()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            ArticleRepository::class => new JsonPlaceHolderArticleRepository(),
            UserRepository::class => new JsonPlaceHolderUserRepository(),
            CommentRepository::class => new JsonPlaceHolderCommentRepository()
        ]);

        $this->container= $builder->build();
    }
    public function getContainer(){
        return $this->container;
    }
}