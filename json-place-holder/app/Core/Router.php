<?php

namespace App\Core;


use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\JsonPlaceHolderCommentRepository;
use App\Repositories\User\JsonPlaceHolderUserRepository;
use App\Repositories\User\UserRepository;
use FastRoute;
use FastRoute\Dispatcher;
use DI\ContainerBuilder;
use App\Repositories\Article\JsonPlaceHolderArticleRepository;
use App\Repositories\Article\ArticleRepository;

class Router
{
    public static function Router()
    {

        define('ROOT_DIR', realpath(__DIR__ . '/../..'));
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            ArticleRepository::class => new JsonPlaceHolderArticleRepository(),
            UserRepository::class => new JsonPlaceHolderUserRepository(),
            CommentRepository::class => new JsonPlaceHolderCommentRepository()
        ]);
        $container = $builder->build();
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

            $r->addRoute(['GET'], '/', '\App\Controllers\ArticlesController@home');
            $r->addRoute(['GET'], '/allPosts', '\App\Controllers\ArticlesController@allPosts');

            $r->addRoute(['GET'], '/allUsers', '\App\Controllers\UsersController@AllUsers');
            $r->addRoute(['GET'], '/users[/{id}]', '\App\Controllers\UsersController@user');
            $r->addRoute(['GET'], '/posts[/{id}]', '\App\Controllers\ArticlesController@post');

        });

        // Fetch method and URI from somewhere
        $httpMethod = 'GET';
        $uri = $_SERVER['REQUEST_URI'];


        // Strip query string (?foo=bar) and decode URI

        if (false !== $pos = strpos($uri, '?')) {

            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                if (!isset($vars['id'])) {
                    $vars['id'] = 0;
                }

                [$controllerName, $methodName] = explode('@', $handler);
//                $controller = new $controllerName;
//                $response = $controller->{$methodName}((int)($vars['id']));

                $controller = $container->get($controllerName);
                return $controller->{$methodName}((int)($vars['id']));

        }
        return null;
    }
}
