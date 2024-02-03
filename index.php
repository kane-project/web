<?php

require 'vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function (RouteCollector $r) {

    // Client (Public) Routes

    $r->addRoute('GET', '[/]', '/client/home.php');
    $r->addRoute('GET', '/listings[/]', '/client/listings.php');
    $r->addRoute('GET', '/listing/{slug}[/]', '/client/viewlisting.php');
    $r->addRoute('GET', '/about[/]', '/client/about.php');
    $r->addRoute('GET', '/contact[/]', '/client/contact.php');
    $r->addRoute('GET', '/account[/]', '/client/account.php');
    $r->addRoute('GET', '/account/login[/]', '/client/login.php');
    $r->addRoute('GET', '/account/register[/]', '/client/register.php');
    $r->addRoute('GET', '/account/messages[/]', '/client/messages.php');
    $r->addRoute('GET', '/account/logout[/]', '/client/logout.php');
    $r->addRoute('GET', '/account/chat/{slug}[/]', '/client/viewchat.php');
    $r->addRoute('GET', '/safety[/]', '/client/safety.php');
    $r->addRoute('GET', '/legal/{page}[/]', '/client/legal.php');

    // Landlord Portal Routes

    $r->addRoute('GET', '/portal[/]', '/portal/dashboard.php');
    $r->addRoute('GET', '/portal/login[/]', '/portal/login.php');
    $r->addRoute('POST', '/portal/login[/]', '/portal/login.php');
    $r->addRoute('GET', '/portal/register[/]', '/portal/register.php');
    $r->addRoute('GET', '/portal/logout[/]', '/portal/logout.php');
    $r->addRoute('GET', '/portal/new[/]', '/portal/addlisting.php');
    $r->addRoute('POST', '/portal/new[/]', '/portal/addlisting.php');
    $r->addRoute('GET', '/portal/listings[/]', '/portal/mylistings.php');
    $r->addRoute('GET', '/portal/listing/{slug}[/]', '/portal/listingview.php');
    $r->addRoute('GET', '/portal/messages[/]', '/portal/messages.php');
    $r->addRoute('GET', '/portal/message/{id}[/]', '/portal/messageview.php');
    $r->addRoute('GET', '/portal/settings[/]', '/portal/settings.php');

    // Site Admin Routes

    $r->addRoute('GET', '/admin[/]', '/admin/dashboard.php');
    $r->addRoute('GET', '/admin/login[/]', '/admin/login.php');
    $r->addRoute('GET', '/admin/users[/]', '/admin/users.php');
    $r->addRoute('GET', '/admin/user/{id}[/]', '/admin/viewuser.php');
    $r->addRoute('GET', '/admin/listings[/]', '/admin/listings.php');
    $r->addRoute('GET', '/admin/viewlisting/{id}[/]', '/admin/viewlisting.php');
    $r->addRoute('GET', '/admin/reports[/]', '/admin/reports.php');
    $r->addRoute('GET', '/admin/report/{id}[/]', '/admin/viewreport.php');
    $r->addRoute('GET', '/admin/logout[/]', '/admin/logout.php');

});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
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
