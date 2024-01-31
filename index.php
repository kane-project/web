<?php

require 'vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function (RouteCollector $r) {

    // Client (Public) Routes

    $r->addRoute('GET', '/kane-web[/]', '/client/home.php');
    $r->addRoute('GET', '/kane-web/listings[/]', '/client/listings.php');
    $r->addRoute('GET', '/kane-web/listing/{slug}[/]', '/client/viewlisting.php');
    $r->addRoute('GET', '/kane-web/about[/]', '/client/about.php');
    $r->addRoute('GET', '/kane-web/contact[/]', '/client/contact.php');
    $r->addRoute('GET', '/kane-web/account[/]', '/client/account.php');
    $r->addRoute('GET', '/kane-web/account/login[/]', '/client/login.php');
    $r->addRoute('GET', '/kane-web/account/register[/]', '/client/register.php');
    $r->addRoute('GET', '/kane-web/account/messages[/]', '/client/messages.php');
    $r->addRoute('GET', '/kane-web/account/logout[/]', '/client/logout.php');
    $r->addRoute('GET', '/kane-web/account/chat/{slug}[/]', '/client/viewchat.php');
    $r->addRoute('GET', '/kane-web/safety[/]', '/client/safety.php');
    $r->addRoute('GET', '/kane-web/legal/{page}[/]', '/client/legal.php');

    // Landlord Portal Routes

    $r->addRoute('GET', '/kane-web/portal[/]', '/portal/dashboard.php');
    $r->addRoute('GET', '/kane-web/portal/login[/]', '/portal/login.php');
    $r->addRoute('GET', '/kane-web/portal/register[/]', '/portal/register.php');
    $r->addRoute('GET', '/kane-web/portal/logout[/]', '/portal/logout.php');
    $r->addRoute('GET', '/kane-web/portal/new[/]', '/portal/addlisting.php');
    $r->addRoute('GET', '/kane-web/portal/my-listings[/]', '/portal/mylistings.php');
    $r->addRoute('GET', '/kane-web/portal/listing/{slug}[/]', '/portal/listingview.php');
    $r->addRoute('GET', '/kane-web/portal/messages[/]', '/portal/messages.php');
    $r->addRoute('GET', '/kane-web/portal/message/{id}[/]', '/portal/messageview.php');

    // Site Admin Routes

    $r->addRoute('GET', '/kane-web/admin[/]', '/admin/dashboard.php');
    $r->addRoute('GET', '/kane-web/admin/login[/]', '/admin/login.php');
    $r->addRoute('GET', '/kane-web/admin/users[/]', '/admin/users.php');
    $r->addRoute('GET', '/kane-web/admin/user/{id}[/]', '/admin/viewuser.php');
    $r->addRoute('GET', '/kane-web/admin/listings[/]', '/admin/listings.php');
    $r->addRoute('GET', '/kane-web/admin/viewlisting/{id}[/]', '/admin/viewlisting.php');
    $r->addRoute('GET', '/kane-web/admin/reports[/]', '/admin/reports.php');
    $r->addRoute('GET', '/kane-web/admin/report/{id}[/]', '/admin/viewreport.php');
    $r->addRoute('GET', '/kane-web/admin/logout[/]', '/admin/logout.php');

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
