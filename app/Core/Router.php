<?php

namespace App\Core;

use FastRoute\Dispatcher;

class Router
{
    public static function Router()
    {
        Functions::defineRootDir();
        Functions::loadDotEnv();

        $container = (new Container())->getContainer();
        $dispatcher = (new Routes())->getDispatcher();

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
                $controller = $container->get($controllerName);
                return $controller->{$methodName}((int)($vars['id']));
        }
        return null;
    }
}
