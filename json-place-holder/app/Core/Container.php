<?php


namespace App\Core;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\LocalDbArticleRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\LocalDbCommentRepository;
use App\Repositories\User\LocalDbUserRepository;
use App\Repositories\User\UserRepository;
use DI\ContainerBuilder;

//use App\Repositories\Article\JsonPlaceHolderArticleRepository;

//use App\Repositories\Comment\JsonPlaceHolderCommentRepository;

//use App\Repositories\User\JsonPlaceHolderUserRepository;

class Container
{
    protected object $container;

    public function __construct()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([

//Local Database Resource
            ArticleRepository::class => new LocalDbArticleRepository(),
            CommentRepository::class => new LocalDbCommentRepository(),
            UserRepository::class => new LocalDbUserRepository(),

//JSON Place Holder API Resource
//            ArticleRepository::class => new JsonPlaceHolderArticleRepository(),
//            UserRepository::class => new JsonPlaceHolderUserRepository(),
//            CommentRepository::class => new JsonPlaceHolderCommentRepository()

        ]);

        $this->container = $builder->build();
    }

    public function getContainer()
    {
        return $this->container;
    }
}