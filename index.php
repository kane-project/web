<?php

require 'vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/kane-web[/]', '/home.php');
    $r->addRoute('GET', '/kane-web/listings[/]', '/listings.php');
    $r->addRoute('GET', '/kane-web/listing/{slug}[/]', '/viewlisting.php');
    $r->addRoute('GET', '/kane-web/about[/]', '/about.php');
    $r->addRoute('GET', '/kane-web/contact[/]', '/contact.php');
    $r->addRoute('GET', '/kane-web/legal/{page}[/]', '/legal.php');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) 
{
    case \FastRoute\Dispatcher::FOUND:
        $page = $routeInfo[1];
        include(__DIR__ . '/public' . $page);
        break;

    case \FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        include(__DIR__ . '/public' . '/404.php');
        break;

    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '<pre>405 Method Not Allowed</pre>';
        break;
}
