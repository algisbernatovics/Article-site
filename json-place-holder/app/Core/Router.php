<?php

namespace App\Core;

use FastRoute;
use FastRoute\Dispatcher;


class Router
{
    public static function Router()
    {

        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

            $r->addRoute(['GET'], '/', '\App\Controller\PagesController@home');
            $r->addRoute(['GET'], '/allUsers', '\App\Controller\PagesController@AllUsers');

            $r->addRoute(['GET'], '/users[/{page}]', '\App\Controller\SinglePageController@user');
            $r->addRoute(['GET'], '/posts[/{page}]', '\App\Controller\SinglePageController@post');

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
                [$controllerName, $methodName] = explode('@', $handler);
                $controller = new $controllerName;
                $response = $controller->{$methodName}((int)($vars['page']));
        }
        return $response;
    }
}