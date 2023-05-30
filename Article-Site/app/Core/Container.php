<?php


namespace App\Core;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\LocalDbArticleRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\LocalDbCommentRepository;
use App\Repositories\User\LocalDbUserRepository;
use App\Repositories\User\UserRepository;
use DI\ContainerBuilder;

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

        ]);

        $this->container = $builder->build();
    }

    public function getContainer()
    {
        return $this->container;
    }
}